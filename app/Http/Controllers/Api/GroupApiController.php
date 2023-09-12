<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permissions\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GroupApiController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Group::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name, '-'),
            'description' => $request->description,
        ]);

        return redirect()->route('groups.index');
    }

    /**
     * @param Request $request
     * @param string $groupId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, string $groupId)
    {
        $group = Group::find($groupId);
        $group->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name, '-'),
            'description' => $request->description,
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
        Group::find($groupId)->delete();

        return redirect()->route('groups.index');
    }
}
