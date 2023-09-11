<?php

namespace Tests\Feature\Group;

use App\Models\Permissions\Group;
use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class UpdateGroupTest extends TestCase
{
    /**
     * @test
     */
    public function it_shoud_be_able_to_update_a_group(): void
    {
        $user  = User::factory()->createOne();
        $group = Group::factory()->createOne();

        $newGroupName = 'New Group Name';

        $this->actingAs($user);
        $this->put(route('groups.api.edit', $group->id), [
            'name'        => $newGroupName,
            'slug'        => Str::slug($newGroupName, '-'),
            'description' => 'New Group Description',
        ])->assertRedirect(route('groups.index'));

        $group->refresh();

        $this->assertEquals($newGroupName, $group->name);
        $this->assertEquals(Str::slug($newGroupName, '-'), $group->slug);
        $this->assertEquals('New Group Description', $group->description);

    }
}
