<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Base\BaseApiController;
use App\Models\Permissions\Group;
use Illuminate\Http\Request;

class GroupApiController extends BaseApiController
{
    public function __construct()
    {
        parent::__construct(Group::class);
    }

    /**
     * @param Request $request
     * @param string $groupId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, string $groupId)
    {
        Group::find($groupId)->forceDelete();

        return redirect()->route('groups.index');
    }
}
