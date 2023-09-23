<?php

namespace Tests\Feature\PermissionUser;

use App\Models\Permissions\Group;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class PermissionUserTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_be_able_to_authorize_access_to_a_route_based_on_the_permission()
    {
        Route::get('/testing-permission', function () {
            return 'You have the permission to view this route.';
        })->middleware('permission:permission-user');

        $user = User::factory()->createOne();
        $this->actingAs($user);

        $this->get('/testing-permission')
             ->assertForbidden();

        $group = Group::factory()->createOne();

        $user->addToGroup($group->id);
        $group->givePermissionTo('permission-user');

        $this->get('/testing-permission')
             ->assertSuccessful();
    }
}
