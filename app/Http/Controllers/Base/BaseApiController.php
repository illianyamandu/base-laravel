<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Models\Base\BaseModel;
use Illuminate\Http\{JsonResponse, Request};

abstract class BaseApiController extends Controller
{
    public function __construct(protected string $class)
    {
        if (!is_subclass_of($this->class, BaseModel::class)) {
            throw new \InvalidArgumentException(
                "A classe {$this->class} não é uma subclasse \App\Models\Base\BaseModel"
            );
        }

        $this->class = $class;
    }

    public function list(Request $request): JsonResponse
    {
        return $this->class::list($request);
    }

    public function detailed(Request $request, string $id): JsonResponse
    {
        return $this->class::detailed($request, $id);
    }

    public function store(Request $request): JsonResponse
    {
        return $this->class::store($request);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        return $this->class::edit($request, $id);
    }

    public function destroy(Request $request, string $id): JsonResponse
    {
        return $this->class::deleteItem($request, $id, false);
    }

    public function archive(Request $request, string $id): JsonResponse
    {
        return $this->class::deleteItem($request, $id, true);
    }

}
