<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Base\BaseWebController;
use App\Models\Permissions\Group;

class GroupAdminController extends BaseWebController
{
    public function __construct()
    {
        parent::__construct(new Group());
    }
}
