<?php

namespace App\Models\Base;

use App\Traits\Guid;
use Illuminate\Database\Eloquent\{Builder, Collection, Model, SoftDeletes};
use Illuminate\Http\Request;

class BaseModel extends Model
{
    use SoftDeletes;
    use Guid;

    /**
     * @var string
     */
    public static $guidempty = "00000000-0000-0000-0000-000000000000";

    /**
     * @return string[]
     */
    public function getListingData()
    {
        return $this->fillable;
    }

    /**
     * @param Builder $query
     * @param Request $request
     * @return Builder
     */
    public function addListingFilters(Builder $query, Request $request): Builder
    {
        return $query;
    }

    /**
     * @param Request $request
     * @return Collection
     */
    public static function listing(Request $request)
    {
        $instance    = new self();
        $listingData = $instance->getListingData();

        /** Building query */
        $query = self::query();
        $query = $instance->addListingFilters($query, $request);

        return $query->get($listingData);
    }
}
