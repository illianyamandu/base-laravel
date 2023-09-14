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

    /**
     * @test
     */
    public function name_shoul_be_not_updated_id_not_provided()
    {
        $user  = User::factory()->createOne();
        $group = Group::factory()->createOne();

        $name = $group->name;

        $this->actingAs($user);
        $this->put(route('groups.api.edit', $group->id), [
            'name'        => null,
            'slug'        => Str::slug($name, '-'),
            'description' => 'New Group Description',
        ])->assertRedirect(route('groups.index'));

        $group->refresh();

        $this->assertEquals($name, $group->name);
        $this->assertEquals(Str::slug($name, '-'), $group->slug);
        $this->assertEquals('New Group Description', $group->description);
    }

    /**
     * @test
     */
    public function description_shoul_be_not_updated_id_not_provided()
    {
        $user  = User::factory()->createOne();
        $group = Group::factory()->createOne();

        $name        = 'new name';
        $description = $group->description;

        $this->actingAs($user);
        $this->put(route('groups.api.edit', $group->id), [
            'name'        => $name,
            'slug'        => Str::slug($name, '-'),
            'description' => null,
        ])->assertRedirect(route('groups.index'));

        $group->refresh();

        $this->assertEquals($name, $group->name);
        $this->assertEquals(Str::slug($name, '-'), $group->slug);
        $this->assertEquals($description, $group->description);
    }

    /**
     * @test
     */
    public function slug_should_be_edited_if_the_name_is_edited_and_slug_is_not_provide()
    {
        $user  = User::factory()->createOne();
        $group = Group::factory()->createOne();

        $newGroupName = 'New Group Name';

        $this->actingAs($user);
        $this->put(route('groups.api.edit', $group->id), [
            'name'        => $newGroupName,
            'description' => 'New Group Description',
        ])->assertRedirect(route('groups.index'));

        $group->refresh();

        $this->assertEquals($newGroupName, $group->name);
        $this->assertEquals(Str::slug($newGroupName, '-'), $group->slug);
        $this->assertEquals('New Group Description', $group->description);
    }
}
