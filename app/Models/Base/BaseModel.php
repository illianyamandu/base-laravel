<?php

namespace App\Models\Base;

use App\Interfaces\IBaseModel;
use App\Traits\Guid;
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

    public static function listing(Request $request): Collection
    {
        $instance    = new static();
        $listingData = $instance->getListingData();

        /** Building query */
        $query = self::query();
        $query = $instance->addListingFilters($query, $request);

        return $query->get($listingData);
    }
}
