<?php

namespace Tests\Feature;

use App\Status;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    //Testing actions as a guest

    public function testGuestStore()
    {
        $status = $this->status();
        $params = ['name' => 'test name', 'status_id' => $status->id];
        $response = $this->post(route('tasks.store'), $params);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('tasks', $params);
    }

    public function testGuestUpdate()
    {
        $task = $this->createTestTask();
        $editedParams = ['name' => 'test name', 'status_id' => $task->status->id];
        $response = $this->patch(route('tasks.update', $task), $editedParams);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('tasks', $editedParams);
    }

    public function testGuestDelete()
    {
        $task = $this->createTestTask();
        $response = $this->delete(route('tasks.destroy', $task));

        $response->assertRedirect(route('login'));
        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'name' => $task->name]);
    }

    //Testing actions as a user

    public function testUserStoreSuccess()
    {
        $status = $this->status();
        $params = ['name' => 'test name', 'status_id' => $status->id];
        $this->actingAs($this->user())
            ->post(route('tasks.store'), $params)
            ->assertStatus(302)
            ->assertSessionHasNoErrors();
        $this->assertDatabaseHas('tasks', $params);
    }

    public function testUserStoreFail()
    {
        $status = $this->status();
        $params = ['name' => str_repeat('test', 20), 'status_id' => $status->id];
        $this->actingAs($this->user())
            ->post(route('tasks.index'), $params)
            ->assertStatus(302)
            ->assertSessionHasErrors();
        $this->assertDatabaseMissing('tasks', $params);
    }

    public function testUserUpdateSuccess()
    {
        $task = $this->createTestTask();
        $status = $this->status();

        $editedParams = ['name' => 'edited test name', 'status_id' => $status->id];
        $this->actingAs($task->creator)
            ->patch(route('tasks.update', $task), $editedParams)
            ->assertStatus(302)
            ->assertSessionHasNoErrors();
        $this->assertDatabaseHas("tasks", $editedParams);
    }

    public function testUserUpdateFail()
    {
        $task = $this->createTestTask();
        $status = $this->status();

        $editedParams = ['name' => '12', 'status_id' => $status->id];
        $this->actingAs($task->creator)
            ->patch(route('tasks.update', $task), $editedParams)
            ->assertStatus(302)
            ->assertSessionHasErrors();
        $this->assertDatabaseMissing("tasks", $editedParams);
    }

    public function testUserDeleteFail()
    {
        $task = $this->createTestTask();
        $this->assertDatabaseHas("tasks", ['id' => $task->id]);

        $this->actingAs($this->user())
            ->delete(route('tasks.destroy', $task))
            ->assertStatus(403);
        $this->assertDatabaseHas("tasks", ['id' => $task->id]);
    }

    public function testUserDeleteSuccess()
    {
        $task = $this->createTestTask();
        $this->assertDatabaseHas("tasks", ['id' => $task->id]);

        $this->actingAs($task->creator)
            ->delete(route('tasks.destroy', $task))
            ->assertStatus(302)
            ->assertSessionHasNoErrors();
        $this->assertSoftDeleted("tasks", ['id' => $task->id]);
    }

    //Testing actions that both users and guests are able to perform

    public function testIndex()
    {
        $this->createTestTask();
        $response = $this->get(route('tasks.index'));
        $response->assertStatus(200);
    }

    public function testShowIndex()
    {
        $task = $this->createTestTask();
        $response = $this->get(route('tasks.show', compact('task')));
        $response->assertStatus(200);
    }

    //Helpers

    private function createTestTask()
    {
        $status = factory(Status::class)->create();
        $user = factory(User::class)->create();
        $task = factory(Task::class)->make();

        $task->status()->associate($status);
        $task->creator()->associate($user);
        $task->save();
        $task->assignees()->attach($user);
        $task->save();

        return $task;
    }
}
