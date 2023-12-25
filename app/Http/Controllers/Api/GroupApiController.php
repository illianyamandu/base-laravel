<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Base\BaseApiController;
use App\Models\Permissions\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
    public function edit(Request $request, string $groupId)
    {
        $group = Group::find($groupId);
        $name  = $request->name ?? $group->name;
        $group->update([
            'name'        => $name,
            'slug'        => Str::slug($name, '-'),
            'description' => $request->description ?? $group->description,
        ]);

        return redirect()->route('groups.index');
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
