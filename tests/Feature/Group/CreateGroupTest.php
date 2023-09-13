<?php

namespace Tests\Feature\Group;

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

        $this->assertDatabaseMissing('groups', [
            'name'        => $groupName,
            'slug'        => Str::slug($groupName, '-'),
            'description' => 'Funcionários da equipe',
        ]);

    }
}
