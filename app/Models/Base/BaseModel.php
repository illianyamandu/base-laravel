<?php

namespace App\Models\Base;

use App\Interfaces\IBaseModel;
use App\Traits\Guid;
use App\Utils\BaseJsonResponse;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Database\Eloquent\{Builder, Collection, Model, SoftDeletes};
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Support\Facades\{DB, Log, Validator};

abstract class BaseModel extends Model implements IBaseModel
{
    use SoftDeletes;
    use Guid;

    public static string $guidempty = "00000000-0000-0000-0000-000000000000";

    /**
     * @return string[]
     */
    public function getListingData()
    {
        return $this->getFillable();
    }

    public function addListingFilters(Builder $query, Request $request): Builder
    {
        return $query;
    }

    /**
     * @return Collection|LengthAwarePaginator
     */
    public static function listing(Request $request, bool $noPagination = false, int $perPage = 10)
    {
        $instance    = new static();
        $listingData = $instance->getListingData();

        /** Building query */
        $query = self::query();
        $query = $instance->addListingFilters($query, $request);

        if ($noPagination) {
            return $query->get($listingData);
        }

        return $query->paginate($perPage, $listingData);
    }

    public static function list(Request $request, bool $noPagination = false, int $perPage = 10): JsonResponse
    {
        try {
            $data = static::listing($request, $noPagination, $perPage);

            if ($data instanceof Exception) return BaseJsonResponse::exception($data);

            return BaseJsonResponse::success("Lista", $data->toArray());
        } catch (Exception $e) {
            return BaseJsonResponse::exception($e);
        }
    }

    /**
     * @return array<string, string>
     */
    public function getValidatorErrorMessages(): array
    {
        return [
            'accepted'        => 'O campo :attribute deve ser aceito.',
            'active_url'      => 'O campo :attribute não é uma URL válida.',
            'after'           => 'O campo :attribute deve ser uma data posterior a :date.',
            'after_or_equal'  => 'O campo :attribute deve ser uma data posterior ou igual a :date.',
            'alpha'           => 'O campo :attribute só pode conter letras.',
            'alpha_dash'      => 'O campo :attribute só pode conter letras, números e traços.',
            'alpha_num'       => 'O campo :attribute só pode conter letras e números.',
            'array'           => 'O campo :attribute deve ser uma matriz.',
            'before'          => 'O campo :attribute deve ser uma data anterior :date.',
            'before_or_equal' => 'O campo :attribute deve ser uma data anterior ou igual a :date.',
            'between'         => [
                'numeric' => 'O campo :attribute deve ser entre :min e :max.',
                'file'    => 'O campo :attribute deve ser entre :min e :max kilobytes.',
                'string'  => 'O campo :attribute deve ser entre :min e :max caracteres.',
                'array'   => 'O campo :attribute deve ter entre :min e :max itens.',
            ],
            'boolean'        => 'O campo :attribute deve ser verdadeiro ou falso.',
            'confirmed'      => 'O campo :attribute de confirmação não confere.',
            'date'           => 'O campo :attribute não é uma data válida.',
            'date_equals'    => 'O campo :attribute deve ser uma data igual a :date.',
            'date_format'    => 'O campo :attribute não corresponde ao formato :format.',
            'different'      => 'Os campos :attribute e :other devem ser diferentes.',
            'digits'         => 'O campo :attribute deve ter :digits dígitos.',
            'digits_between' => 'O campo :attribute deve ter entre :min e :max dígitos.',
            'dimensions'     => 'O campo :attribute tem dimensões de imagem inválidas.',
            'distinct'       => 'O campo :attribute campo tem um valor duplicado.',
            'email'          => 'O campo :attribute deve ser um endereço de e-mail válido.',
            'ends_with'      => 'O campo :attribute deve terminar com um dos seguintes: :values',
            'exists'         => 'O campo :attribute selecionado é inválido.',
            'file'           => 'O campo :attribute deve ser um arquivo.',
            'filled'         => 'O campo :attribute deve ter um valor.',
            'gt'             => [
                'numeric' => 'O campo :attribute deve ser maior que :value.',
                'file'    => 'O campo :attribute deve ser maior que :value kilobytes.',
                'string'  => 'O campo :attribute deve ser maior que :value caracteres.',
                'array'   => 'O campo :attribute deve conter mais de :value itens.',
            ],
            'gte' => [
                'numeric' => 'O campo :attribute deve ser maior ou igual a :value.',
                'file'    => 'O campo :attribute deve ser maior ou igual a :value kilobytes.',
                'string'  => 'O campo :attribute deve ser maior ou igual a :value caracteres.',
                'array'   => 'O campo :attribute deve conter :value itens ou mais.',
            ],
            'image'    => 'O campo :attribute deve ser uma imagem.',
            'in'       => 'O campo :attribute selecionado é inválido.',
            'in_array' => 'O campo :attribute não existe em :other.',
            'integer'  => 'O campo :attribute deve ser um número inteiro.',
            'ip'       => 'O campo :attribute deve ser um endereço de IP válido.',
            'ipv4'     => 'O campo :attribute deve ser um endereço IPv4 válido.',
            'ipv6'     => 'O campo :attribute deve ser um endereço IPv6 válido.',
            'json'     => 'O campo :attribute deve ser uma string JSON válida.',
            'lt'       => [
                'numeric' => 'O campo :attribute deve ser menor que :value.',
                'file'    => 'O campo :attribute deve ser menor que :value kilobytes.',
                'string'  => 'O campo :attribute deve ser menor que :value caracteres.',
                'array'   => 'O campo :attribute deve conter menos de :value itens.',
            ],
            'lte' => [
                'numeric' => 'O campo :attribute deve ser menor ou igual a :value.',
                'file'    => 'O campo :attribute deve ser menor ou igual a :value kilobytes.',
                'string'  => 'O campo :attribute deve ser menor ou igual a :value caracteres.',
                'array'   => 'O campo :attribute não deve conter mais que :value itens.',
            ],
            'max' => [
                'numeric' => 'O campo :attribute não pode ser superior a :max.',
                'file'    => 'O campo :attribute não pode ser superior a :max kilobytes.',
                'string'  => 'O campo :attribute não pode ser superior a :max caracteres.',
                'array'   => 'O campo :attribute não pode ter mais do que :max itens.',
            ],
            'mimes'     => 'O campo :attribute deve ser um arquivo do tipo: :values.',
            'mimetypes' => 'O campo :attribute deve ser um arquivo do tipo: :values.',
            'min'       => [
                'numeric' => 'O campo :attribute deve ser pelo menos :min.',
                'file'    => 'O campo :attribute deve ter pelo menos :min kilobytes.',
                'string'  => 'O campo :attribute deve ter pelo menos :min caracteres.',
                'array'   => 'O campo :attribute deve ter pelo menos :min itens.',
            ],
            'not_in'               => 'O campo :attribute selecionado é inválido.',
            'not_regex'            => 'O campo :attribute possui um formato inválido.',
            'numeric'              => 'O campo :attribute deve ser um número.',
            'password'             => 'A senha está incorreta.',
            'present'              => 'O campo :attribute deve estar presente.',
            'regex'                => 'O campo :attribute tem um formato inválido.',
            'required'             => 'O campo :attribute é obrigatório.',
            'required_if'          => 'O campo :attribute é obrigatório quando :other for :value.',
            'required_unless'      => 'O campo :attribute é obrigatório exceto quando :other for :values.',
            'required_with'        => 'O campo :attribute é obrigatório quando :values está presente.',
            'required_with_all'    => 'O campo :attribute é obrigatório quando :values está presente.',
            'required_without'     => 'O campo :attribute é obrigatório quando :values não está presente.',
            'required_without_all' => 'O campo :attribute é obrigatório quando nenhum dos :values estão presentes.',
            'same'                 => 'Os campos :attribute e :other devem corresponder.',
            'size'                 => [
                'numeric' => 'O campo :attribute deve ser :size.',
                'file'    => 'O campo :attribute deve ser :size kilobytes.',
                'string'  => 'O campo :attribute deve ser :size caracteres.',
                'array'   => 'O campo :attribute deve conter :size itens.',
            ],
            'starts_with' => 'O campo :attribute deve começar com um dos seguintes valores: :values',
            'string'      => 'O campo :attribute deve ser uma string.',
            'timezone'    => 'O campo :attribute deve ser uma zona válida.',
            'unique'      => 'O campo :attribute já está sendo utilizado.',
            'uploaded'    => 'Ocorreu uma falha no upload do campo :attribute.',
            'url'         => 'O campo :attribute tem um formato inválido.',
            'uuid'        => 'O campo :attribute deve ser um UUID válido.',
        ];
    }

    /**
     * @return string[]
     */
    public function fildsForUpdate()
    {
        return $this->getFillable();
    }

    /**
     * @param array<string, mixed> $data
     *
     * @return array<string, mixed>
     */
    public function getStoreValidator($data)
    {
        return [];
    }

    /**
     * @param array<string, mixed> $data
     * @param string $id
     *
     * @return array<string, mixed>
     */
    public function getEditValidator($data, $id)
    {
        return $this->getStoreValidator($data);
    }

    /**
     * @param array<string, mixed> $data
     * @param Model $dbInstance
     *
     * @return array<string, mixed>
     */
    public function cleanDataForUpdate($data, $dbInstance)
    {
        $fildsForUpdate = [];
        $filds          = $this->fildsForUpdate();

        foreach($filds as $fild) {
            if(strcasecmp('id', $fild) == 0)
            continue;

            if(array_key_exists($fild, $data)) {
                $fildsForUpdate[$fild] = $data[$fild];
            }
        }

        return $fildsForUpdate;
    }

    /**
     * @param JsonResponse|Model|ValidationValidator|array<string|int, mixed> $data
     */
    public static function actionSuccess($data): bool
    {
        return !(
            $data instanceof ValidationValidator ||
            ($data instanceof JsonResponse && !$data->original[BaseJsonResponse::$successFild])
        );
    }

    /**
     * @param Model|Exception|ValidationValidator|JsonResponse $data
     * @param bool $doRollback
     *
     * @return JsonResponse
     */
    public static function buildResponse($data, $doRollback = false)
    {
        if ($doRollback) DB::rollback();

        if ($data instanceof Exception) {
            return BaseJsonResponse::exception($data);
        }

        if ($data instanceof ValidationValidator) {
            return BaseJsonResponse::error($data->errors()->all());
        }

        return $data;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @return array<string, mixed>
     */
    public function prepareDataForStoreOrEdit(&$data, bool $updating = false)
    {
        return $data;
    }

    public static function store(Request $request): JsonResponse
    {
        try {
            $item = static::storeData($request->all());

            if (!static::actionSuccess($item)) return static::buildResponse($item);

            return BaseJsonResponse::success("Registro salvo com sucesso", $item->toArray());
        } catch (Exception $e) {
            return BaseJsonResponse::exception($e);
        }
    }

    /**
     * @param array<string, mixed> $data
     *
     * @return Model|ValidationValidator
     */
    public static function storeData($data)
    {
        $instance = new static();
        $instance->prepareDataForStoreOrEdit($data);

        $validator = Validator::make(
            $data,
            $instance->getStoreValidator($data),
            $instance->getValidatorErrorMessages()
        );

        if ($validator->fails()) return $validator;

        return self::create($data);
    }

    public static function edit(Request $request, string $id): JsonResponse
    {
        try {
            $dbInstance = static::find($id);

            if (!$dbInstance) return BaseJsonResponse::notFound("Registro não encontrado");

            $item = static::editData($request->all(), $dbInstance);

            if(!static::actionSuccess($item)) return static::buildResponse($item);

            return BaseJsonResponse::success("Registro atualizado com sucesso", $item->toArray());
        } catch(Exception $e) {
            return BaseJsonResponse::exception($e);
        }
    }

    /**
     * @param array<string, mixed> $data
     * @param mixed $dbInstance
     *
     * @return Model|ValidationValidator
     */
    public static function editData($data, &$dbInstance)
    {
        $instance = new static();
        $instance->prepareDataForStoreOrEdit($data, true);

        $validator = Validator::make(
            $data,
            $instance->getEditValidator($data, $dbInstance->id),
            $instance->getValidatorErrorMessages()
        );

        if ($validator->fails()) return $validator;

        $data = $instance->cleanDataForUpdate($data, $dbInstance);
        $dbInstance->update($data);
        $dbInstance->fresh();

        return $dbInstance;
    }

    public static function deleteItem(Request $request, string $id, bool $onlySoftDelete = true): JsonResponse
    {
        $item = static::find($id);

        if (!$item) return BaseJsonResponse::notFound("Registro não encontrado");

        try {
            if ($onlySoftDelete) {
                $item->delete();
            } else {
                $item->forceDelete();
            }

            return BaseJsonResponse::success("Registro excluído com sucesso");
        } catch (Exception $e) {
            return BaseJsonResponse::exception($e);
        }
    }

    /**
     * @return Model|Collection|array<string, mixed>|null
     */
    public function getDetailedItem(string $id)
    {
        return static::find($id);
    }

    public static function detailed(Request $request, string $id): JsonResponse
    {
        $instance = new static();

        $item = $instance->getDetailedItem($id);

        if (!$item) return BaseJsonResponse::notFound("Registro não encontrado");

        if (!is_array($item)) $item = $item->toArray();

        return BaseJsonResponse::success("Registro encontrado", $item);
    }
}
