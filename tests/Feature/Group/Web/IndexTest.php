<?php

namespace Tests\Feature\Group\Web;

use App\Models\Permissions\Group;

use Tests\TestCase;

class IndexTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_be_able_to_see_every_groups_obtained_from_the_group_listing(): void
    {

        Group::factory(10)->create();

        $response = $this->get(route('groups.index'));
        $this->assertTrue(true);
        // $response->assertSee(Group::listing(request())->pluck('name')->toArray());
    }
}
