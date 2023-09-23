<?php

namespace Tests\Feature\Middlewares;

use App\Models\Permissions\Group;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class CheckPermissionTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_be_able_to_pass_many_permissions_on_checkpermission_middleware(): void
    {
        Route::get('/testing-permission', function () {
            return 'You have the permission to view this route.';
        })->middleware('permission:permission-user|permission-admin');

        $user = User::factory()->createOne();
        $this->actingAs($user);

        $this->get('/testing-permission')
             ->assertForbidden();

        $group = Group::factory()->createOne();

        $user->addToGroup($group->id);
        $group->givePermissionTo('permission-admin');

        $this->get('/testing-permission')
             ->assertSuccessful();
    }
}
