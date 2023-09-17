<?php

namespace Tests\Feature\Permission;

use App\Models\Permissions\Group;
use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class PermissionCreateTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_be_able_to_give_a_permission_to_an_group()
    {
        // Arrange
        $user  = User::factory()->createOne();
        $group = Group::factory()->createOne();

        $this->actingAs($user);

        // Act
        $name           = 'Create Users';
        $identifierName = Str::slug($name);
        $group->givePermissionTo(
            $name,
            'Allow to create users'
        );

        // Assert
        $this->assertTrue($group->hasPermissionTo($identifierName));
        $this->assertDatabaseHas('permissions', [
            'name'            => $name,
            'identifier_name' => $identifierName,
            'description'     => 'Allow to create users',
        ]);
    }

    /**
     * @test
     */
    public function it_should_be_able_to_give_a_permission_to_an_user()
    {
        // Arrange
        $user  = User::factory()->createOne();
        $group = Group::factory()->createOne();

        // Act
        $name           = 'Create Users';
        $identifierName = Str::slug($name);

        $group->givePermissionTo(
            $name,
            'Allow to create users'
        );

        $permission = $group->permissions()->where('identifier_name', $identifierName)->first();

        $user->givePermissionTo(
            $permission->identifier_name,
        );

        // Assert
        $this->assertTrue($user->hasPermissionTo($permission->identifier_name));
        $this->assertDatabaseHas('permission_user', [
            'permission_id' => $permission->id,
            'user_id'       => $user->id,
        ]);
    }
}
