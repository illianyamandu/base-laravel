<?php

namespace App\Models\Permissions;

use App\Models\Base\BaseModel;

class GroupUser extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'group_user';

    /**
     * @var array<string>
     */
    protected $fillable = [
        'group_id', 'user_id',
    ];
}
