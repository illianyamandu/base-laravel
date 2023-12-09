<?php

namespace App\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\{Builder, Collection};
use Illuminate\Http\Request;

interface IBaseModel
{
    public function addListingFilters(Builder $query, Request $request): Builder;

    /**
     * @return string[]
     */
    public function getListingData();

    /**
     * @return Collection|LengthAwarePaginator
     */
    public static function listing(Request $request, bool $noPagination = false, int $perPage = 10);
}
