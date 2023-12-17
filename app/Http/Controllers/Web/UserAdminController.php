<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Base\BaseWebController;
use App\Models\User;

class UserAdminController extends BaseWebController
{
    public function __construct()
    {
        parent::__construct(
            User::class,
            'admin.users.index',
            'admin.users.create',
            'admin.users.edit',
            'admin.users.show',
        );
    }
}
