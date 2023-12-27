<?php

namespace Tests\Feature\Group\API;

use App\Models\Permissions\Group;
use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateGroupTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        /** loading route file manually */
        include_once base_path('routes/api.php');
    }

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
        $request = $this->post('/api/groups', [
            'name'        => $groupName,
            'slug'        => Str::slug($groupName, '-'),
            'description' => 'Funcionários da equipe',
        ]);

        // Assert
        $request->assertStatus(200)
        ->assertJson([
            'success' => true,
        ]);

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
        $request = $this->post('/api/groups', [
            'name'        => $groupName,
            'slug'        => Str::slug($groupName, '-'),
            'description' => 'Funcionários da equipe',
        ]);

        // Assert
        $request->assertStatus(400)
                ->assertJson([
                    'success' => false,
                ]);

        $arrayResponse = (json_decode($request->getContent(), true));
        $this->assertContains('O campo name é obrigatório.', $arrayResponse['errors']);
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
        $request = $this->post('/api/groups', [
            'name'        => $groupName,
            'slug'        => Str::slug($groupName, '-'),
            'description' => null,
        ]);

        // Assert
        $request->assertStatus(400)
                ->assertJson([
                    'success' => false,
                ]);

        $arrayResponse = (json_decode($request->getContent(), true));
        $this->assertContains('O campo description é obrigatório.', $arrayResponse['errors']);
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
        $request = $this->post('/api/groups', [
            'name'        => $groupName,
            'slug'        => null,
            'description' => 'Lorem impsum',
        ]);

        // Assert
        $request->assertStatus(400)
                ->assertJson([
                    'success' => false,
                ]);

        $arrayResponse = (json_decode($request->getContent(), true));
        $this->assertContains('O campo slug é obrigatório.', $arrayResponse['errors']);
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
        $request = $this->post('/api/groups', [
            'name'        => $groupName,
            'slug'        => Str::slug($groupName, '-'),
            'description' => 'Funcionários da equipe',
        ]);

        // Assert
        $request->assertStatus(400)
                ->assertJson([
                    'success' => false,
                ]);

        $arrayResponse = (json_decode($request->getContent(), true));
        $this->assertContains('O campo name não pode ser superior a 255 caracteres.', $arrayResponse['errors']);

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
        $request = $this->post('/api/groups', [
            'name'        => $groupName,
            'slug'        => Str::slug($groupName, '-'),
            'description' => 'Funcionários da equipe',
        ]);

        // Assert
        $request->assertStatus(400)
                ->assertJson([
                    'success' => false,
                ]);

        $arrayResponse = (json_decode($request->getContent(), true));
        $this->assertContains('O campo slug não pode ser superior a 255 caracteres.', $arrayResponse['errors']);
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
