<?php

namespace Tests\Feature\Group\API;

use App\Models\Permissions\Group;
use App\Models\User;
use Tests\TestCase;

class DeleteGroupTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_be_able_to_delete_a_group(): void
    {
        $user  = User::factory()->createOne();
        $group = Group::factory()->createOne();

        $this->actingAs($user);

        $this->delete(route('groups.api.destroy', $group->id))
             ->assertRedirect(route('groups.index'));

        $this->assertDatabaseMissing('groups', [
            'id' => $group->id,
        ]);
    }
}
