<?php

namespace App\Models\Base;

use App\Interfaces\IBaseModel;
use App\Traits\Guid;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\{Builder, Collection, Model, SoftDeletes};
use Illuminate\Http\Request;

class BaseModel extends Model implements IBaseModel
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

    public static function store(Request $request): void
    {

    }
}
