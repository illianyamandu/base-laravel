<?php

namespace App\Models\Permission;

use App\Models\Base\BaseModel;

class Group extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'groups';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'description',
    ];
}
