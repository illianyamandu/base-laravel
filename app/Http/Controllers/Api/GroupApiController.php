<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permissions\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GroupApiController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|max:255',
            'slug'        => 'required|max:255',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

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
        Group::find($groupId)->delete();

        return redirect()->route('groups.index');
    }
}
