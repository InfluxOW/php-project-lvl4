<?php

namespace Tests\Feature;

use App\Enums\TaskStatus;
use App\Label;
use App\TaskStatus as Status;
use App\Task;
use App\User;
use Illuminate\Support\Arr;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        factory(User::class, 10)->create();
        factory(Label::class, 10)->create();
        factory(Status::class)->states(TaskStatus::NEW)->create();

        $this->task = factory(Task::class)->create();
        $this->goodData = Arr::only(factory(Task::class)->make()->toArray(), ['name', 'description', 'status_id']);
        $this->badData = [
            'name' => '12',
            'description' => str_repeat('too long description', 50),
            'status_id' => $this->task->status->id
        ];
    }

    /*
     * Guest tests
     * */

    public function testGuestIndex(): void
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
    }

    public function testGuestShow(): void
    {
        $response = $this->get(route('tasks.show', ['task' => $this->task]));
        $response->assertOk();
    }

    public function testGuestStore(): void
    {
        $response = $this->post(route('tasks.store'), $this->goodData);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('tasks', $this->goodData);
    }

    public function testGuestEdit(): void
    {
        $response = $this->get(route('tasks.edit', $this->task));
        $response->assertRedirect(route('login'));
    }

    public function testGuestUpdate(): void
    {
        $response = $this->patch(route('tasks.update', $this->task), $this->goodData);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('tasks', $this->goodData);
    }

    public function testGuestDelete(): void
    {
        $response = $this->delete(route('tasks.destroy', $this->task));

        $response->assertRedirect(route('login'));
        $this->assertDatabaseHas('tasks', ['id' => $this->task->id, 'name' => $this->task->name]);
    }

    /*
     * Authenticated user tests
     * */

    public function testUserIndex(): void
    {
        $response = $this->actingAs($this->user())->get(route('tasks.index'));
        $response->assertOk();
    }

    public function testUserShow(): void
    {
        $response = $this->actingAs($this->user())->get(route('tasks.show', ['task' => $this->task]));
        $response->assertOk();
    }

    public function testUserStoreSuccess(): void
    {
        $this->actingAs($this->user())
            ->post(route('tasks.store'), $this->goodData)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas('tasks', $this->goodData);
    }

    public function testUserStoreFail(): void
    {
        $this->actingAs($this->user())
            ->post(route('tasks.index'), $this->badData)
            ->assertSessionHasErrors()
            ->assertRedirect();
        $this->assertDatabaseMissing('tasks', $this->badData);
    }

    public function testUserEditSuccess(): void
    {
        $response = $this->actingAs($this->user())->get(route('labels.edit', $this->task));
        $response->assertOk();
    }

    public function testUserUpdateSuccess(): void
    {
        $this->actingAs($this->task->creator)
            ->patch(route('tasks.update', $this->task), $this->goodData)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas('tasks', $this->goodData);
    }

    public function testUserUpdateFail(): void
    {
        $this->actingAs($this->task->creator)
            ->patch(route('tasks.update', $this->task), $this->badData)
            ->assertSessionHasErrors()
            ->assertRedirect();
        $this->assertDatabaseMissing('tasks', $this->badData);
    }

    public function testUserDeleteFail(): void
    {
        $this->actingAs($this->user())
            ->delete(route('tasks.destroy', $this->task))
            ->assertForbidden();
        $this->assertDatabaseHas('tasks', ['id' => $this->task->id]);
    }

    public function testUserDeleteSuccess(): void
    {
        $this->actingAs($this->task->creator)
            ->delete(route('tasks.destroy', $this->task))
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertSoftDeleted('tasks', ['id' => $this->task->id]);
    }
}
