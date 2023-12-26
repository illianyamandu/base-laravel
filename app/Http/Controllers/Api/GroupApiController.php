<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Base\BaseApiController;
use App\Models\Permissions\Group;

class GroupApiController extends BaseApiController
{
    public function __construct()
    {
        parent::__construct(Group::class);
    }
}
