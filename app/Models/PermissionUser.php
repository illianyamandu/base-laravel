<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class PermissionUser extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'permission_user';

    /**
     * @var array<string>
     */
    protected $fillable = [
        'permission_id', 'user_id',
    ];
}
