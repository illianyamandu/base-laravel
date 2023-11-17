<?php

namespace Tests\Feature\Group\API;

use App\Models\Permissions\Group;
use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateGroupTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_be_able_to_create_a_group_item(): void
    {

        // Arrange
        /** @var User $user */
        $user       = User::factory()->createOne();
        $assignedTo = User::factory()->createOne();

        $this->actingAs($user);
        $groupName = 'Funcionário';

        // Act
        $request = $this->post(route('groups.api.store'), [
            'name'        => $groupName,
            'slug'        => Str::slug($groupName, '-'),
            'description' => 'Funcionários da equipe',
        ]);

        // Assert
        $request->assertRedirect(route('groups.index'));

        $this->assertDatabaseHas('groups', [
            'name'        => $groupName,
            'slug'        => Str::slug($groupName, '-'),
            'description' => 'Funcionários da equipe',
        ]);
    }

    /**
     * @test
     */
    public function name_shoud_be_required()
    {
        // Arrange
        /** @var User $user */
        $user = User::factory()->createOne();

        $this->actingAs($user);
        $groupName = null;

        // Act
        $request = $this->post(route('groups.api.store'), [
            'name'        => $groupName,
            'slug'        => Str::slug($groupName, '-'),
            'description' => 'Funcionários da equipe',
        ]);

        // Assert
        $request->assertStatus(401)
                ->assertJsonPath('error.name', [
                    'The name field is required.',
                ]);
    }

    /**
     * @test
     */
    public function description_shoud_be_required()
    {
        // Arrange
        /** @var User $user */
        $user = User::factory()->createOne();

        $this->actingAs($user);
        $groupName = 'Funcionário';

        // Act
        $request = $this->post(route('groups.api.store'), [
            'name'        => $groupName,
            'slug'        => Str::slug($groupName, '-'),
            'description' => null,
        ]);

        // Assert
        $request->assertStatus(401)
                ->assertJsonPath('error.description', [
                    'The description field is required.',
                ]);
    }

    /**
     * @test
     */
    public function slug_shoud_be_required()
    {
        // Arrange
        /** @var User $user */
        $user = User::factory()->createOne();

        $this->actingAs($user);
        $groupName = 'Funcionário';

        // Act
        $request = $this->post(route('groups.api.store'), [
            'name'        => $groupName,
            'slug'        => null,
            'description' => 'Lorem impsum',
        ]);

        // Assert
        $request->assertStatus(401)
                ->assertJsonPath('error.slug', [
                    'The slug field is required.',
                ]);
    }

    /**
     * @test
     */
    public function name_should_be_have_maximum_255_character()
    {
        // Arrange
        /** @var User $user */
        $user = User::factory()->createOne();

        $this->actingAs($user);
        $groupName = str_repeat('a', 256);

        // Act
        $request = $this->post(route('groups.api.store'), [
            'name'        => $groupName,
            'slug'        => Str::slug($groupName, '-'),
            'description' => 'Funcionários da equipe',
        ]);

        // Assert
        $request->assertStatus(401)
                ->assertJsonPath('error.name', [
                    'The name field must not be greater than 255 characters.',
                ]);

    }

    /**
     * @test
     */
    public function slug_should_be_have_maximum_255_character()
    {
        // Arrange
        /** @var User $user */
        $user = User::factory()->createOne();

        $this->actingAs($user);
        $groupName = str_repeat('a', 256);

        // Act
        $request = $this->post(route('groups.api.store'), [
            'name'        => $groupName,
            'slug'        => Str::slug($groupName, '-'),
            'description' => 'Funcionários da equipe',
        ]);

        // Assert
        $request->assertStatus(401)
                ->assertJsonPath('error.slug', [
                    'The slug field must not be greater than 255 characters.',
                ]);
    }

    /**
     * @test
     */
    public function it_should_be_able_to_add_a_group_to_a_user()
    {
        // Arrange
        /** @var User $user */
        $user = User::factory()->createOne();

        /** @var Group $user */
        $group = Group::factory()->createOne();

        // Act
        $user->addToGroup($group->id);

        // Assert
        $this->assertTrue($user->belongsToTheGroup($group->id));
        $this->assertDatabaseHas('group_user', [
            'user_id'  => $user->id,
            'group_id' => $group->id,
        ]);
    }
}
