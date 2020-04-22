<?php

namespace Tests\Feature;

use App\TaskStatus as Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
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

    //Testing actions as a user

    public function testUserStoreSuccess()
    {
        $this->actingAs($this->user())
            ->post(route('task_statuses.store'), $this->goodData)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas('task_statuses', $this->goodData);
    }

    public function testUserStoreFail()
    {
        $this->actingAs($this->user())
            ->post(route('task_statuses.index'), $this->badData)
            ->assertSessionHasErrors()
            ->assertRedirect();
        $this->assertDatabaseMissing('task_statuses', $this->badData);
    }

    public function testUserEditSuccess()
    {
        $response = $this->actingAs($this->user())->get(route('task_statuses.edit', $this->status));
        $response->assertOk();
    }

    public function testUserUpdateSuccess()
    {
        $this->actingAs($this->user())
            ->patch(route('task_statuses.update', $this->status), $this->goodData)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas("task_statuses", $this->goodData);
    }

    public function testUserUpdateFail()
    {
        $this->actingAs($this->user())
            ->patch(route('task_statuses.update', $this->status), $this->badData)
            ->assertSessionHasErrors()
            ->assertRedirect();
        $this->assertDatabaseMissing("task_statuses", $this->badData);
    }

    public function testUserDeleteSuccess()
    {
        $this->actingAs($this->user())
            ->delete(route('task_statuses.destroy', $this->status))
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertSoftDeleted("task_statuses", ['id' => $this->status->id]);
    }

    //Testing actions that both users and guests are able to perform

    public function testIndex()
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertOk();
    }
}
