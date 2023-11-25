<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\{Builder, Collection};
use Illuminate\Http\Request;

interface IBaseModel
{
    public function addListingFilters(Builder $query, Request $request): Builder;

    /**
     * @return string[]
     */
    public function getListingData();

    public static function listing(Request $request): Collection;
}
