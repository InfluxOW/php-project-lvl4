<?php

namespace Tests\Feature;

use App\TaskStatus as Status;
use Illuminate\Support\Arr;
use Tests\TestCase;

class TaskStatusControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->status = factory(Status::class)->create();

        $this->goodData = Arr::only(factory(Status::class)->make()->toArray(), ['name']);
        $this->badData = ['name' => '12'];
    }

    /*
     * Guest tests
     * */

    public function testGuestIndex()
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertOk();
    }

    public function testGuestStore(): void
    {
        $response = $this->post(route('task_statuses.store'), $this->goodData);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('task_statuses', $this->goodData);
    }

    public function testGuestEdit(): void
    {
        $response = $this->get(route('task_statuses.edit', $this->status));
        $response->assertRedirect(route('login'));
    }

    public function testGuestUpdate(): void
    {
        $response = $this->patch(route('task_statuses.update', $this->status), $this->goodData);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('task_statuses', $this->goodData);
    }

    public function testGuestDelete(): void
    {
        $response = $this->delete(route('task_statuses.destroy', $this->status));

        $response->assertRedirect(route('login'));
        $this->assertDatabaseHas('task_statuses', ['id' => $this->status->id]);
    }

    /*
     * Authenticated user tests
     * */

    public function testUserIndex()
    {
        $response = $this->actingAs($this->user())->get(route('task_statuses.index'));
        $response->assertOk();
    }

    public function testUserStoreSuccess(): void
    {
        $this->actingAs($this->user())
            ->post(route('task_statuses.store'), $this->goodData)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas('task_statuses', $this->goodData);
    }

    public function testUserStoreFail(): void
    {
        $this->actingAs($this->user())
            ->post(route('task_statuses.index'), $this->badData)
            ->assertSessionHasErrors()
            ->assertRedirect();
        $this->assertDatabaseMissing('task_statuses', $this->badData);
    }

    public function testUserEditSuccess(): void
    {
        $response = $this->actingAs($this->user())->get(route('task_statuses.edit', $this->status));
        $response->assertOk();
    }

    public function testUserUpdateSuccess(): void
    {
        $this->actingAs($this->user())
            ->patch(route('task_statuses.update', $this->status), $this->goodData)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas("task_statuses", $this->goodData);
    }

    public function testUserUpdateFail(): void
    {
        $this->actingAs($this->user())
            ->patch(route('task_statuses.update', $this->status), $this->badData)
            ->assertSessionHasErrors()
            ->assertRedirect();
        $this->assertDatabaseMissing("task_statuses", $this->badData);
    }

    public function testUserDeleteSuccess(): void
    {
        $this->actingAs($this->user())
            ->delete(route('task_statuses.destroy', $this->status))
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertSoftDeleted("task_statuses", ['id' => $this->status->id]);
    }
}
