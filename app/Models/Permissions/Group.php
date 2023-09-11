<?php

namespace App\Models\Permissions;

use App\Models\Base\BaseModel;

class Group extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'groups';

    /**
     * @var array<string>
     */
    protected $fillable = [
        'name', 'slug', 'description',
    ];
}
