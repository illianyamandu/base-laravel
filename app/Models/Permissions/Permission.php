<?php

namespace App\Models\Permissions;

use App\Models\Base\BaseModel;

class Permission extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'permissions';

    /**
     * @var array<string>
     */
    protected $fillable = [
        'identifier_name', 'name', 'description',
    ];
}
