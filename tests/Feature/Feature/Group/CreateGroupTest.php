<?php

namespace Tests\Feature\Feature\Group;

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

        // Act
        $this->post(route('group.api.store'), [
            'name'        => 'Funcionário',
            'slug'        => Str::slug('Funcionário', '-'),
            'description' => 'Funcionários da equipe',
        ]);

    }
}
