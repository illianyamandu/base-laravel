<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Base\BaseWebController;
use App\Models\Permissions\Group;

class GroupAdminController extends BaseWebController
{
    public function __construct()
    {
        parent::__construct(
            Group::class,
            'admin.groups.index',
            'admin.groups.create',
            'admin.groups.edit',
            'admin.groups.show',
        );
    }
}
