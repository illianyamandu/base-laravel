<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Models\Base\BaseModel;
use Illuminate\Http\{JsonResponse, Request};

class BaseApiController extends Controller
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

    public function store(Request $request): JsonResponse
    {
        return $this->class::store($request);
    }

}
