<?php

namespace Tests\Feature;

use App\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class StatusControllerTest extends TestCase
{
    use RefreshDatabase;

    //Testing actions as a guest

    public function testGuestStore()
    {
        $params = ['name' => 'test name'];
        $response = $this->post(route('statuses.store'), $params);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('statuses', $params);
    }

    public function testGuestUpdate()
    {
        $status = $this->createTestStatus();
        $editedParams = ['name' => 'test name'];
        $response = $this->patch(route('statuses.update', $status), $editedParams);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('statuses', $editedParams);
    }

    public function testGuestDelete()
    {
        $status = $this->createTestStatus();
        $response = $this->delete(route('statuses.destroy', $status));

        $response->assertRedirect(route('login'));
        $this->assertDatabaseHas('statuses', ['id' => $status->id, 'name' => $status->name]);
    }

    //Testing actions as a user

    public function testUserStoreSuccess()
    {
        $params = ['name' => 'test name'];
        $this->actingAs($this->user())
            ->post(route('statuses.store'), $params)
            ->assertStatus(302)
            ->assertSessionHasNoErrors();
        $this->assertDatabaseHas('statuses', $params);
    }

    public function testUserStoreFail()
    {
        $params = ['name' => str_repeat('test', 10)];
        $this->actingAs($this->user())
            ->post(route('statuses.index'), $params)
            ->assertStatus(302)
            ->assertSessionHasErrors();
        $this->assertDatabaseMissing('statuses', $params);
    }

    public function testUserUpdateSuccess()
    {
        $status = $this->createTestStatus();

        $editedParams = ['name' => 'edited test name'];
        $this->actingAs($this->user())
            ->patch(route('statuses.update', $status), $editedParams)
            ->assertStatus(302)
            ->assertSessionHasNoErrors();
        $this->assertDatabaseHas("statuses", $editedParams);
    }

    public function testUserUpdateFail()
    {
        $status = $this->createTestStatus();

        $editedParams = ['name' => '12'];
        $this->actingAs($this->user())
            ->patch(route('statuses.update', $status), $editedParams)
            ->assertStatus(302)
            ->assertSessionHasErrors();
        $this->assertDatabaseMissing("statuses", $editedParams);
    }

    public function testUserDeleteSuccess()
    {
        $status = $this->createTestStatus();
        $this->assertDatabaseHas("statuses", ['id' => $status->id]);

        $this->actingAs($this->user())
            ->delete(route('statuses.destroy', $status))
            ->assertStatus(302)
            ->assertSessionHasNoErrors();
        $this->assertSoftDeleted("statuses", ['id' => $status->id]);
    }

    //Testing actions that both users and guests are able to perform

    public function testIndex()
    {
        $this->createTestStatus();
        $response = $this->get(route('statuses.index'));
        $response->assertStatus(200);
    }

    //Helpers

    private function createTestStatus()
    {
        return factory(Status::class)->create();
    }
}
