<?php

namespace Tests\Feature;

use App\Label;
use App\TaskStatus as Status;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        factory(User::class, 10)->create();
        factory(Label::class, 10)->create();
        factory(Status::class)->states('new')->create();

        $this->task = factory(Task::class)->create();
        $this->goodData = Arr::only(factory(Task::class)->make()->toArray(), ['name', 'description', 'status_id']);
    }

    //Testing actions as a user

    public function testUserStore()
    {
        $this->actingAs($this->user())
            ->post(route('tasks.store'), $this->goodData)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas('tasks', $this->goodData);
    }

    public function testUserEdit()
    {
        $response = $this->actingAs($this->user())->get(route('labels.edit', $this->task));
        $response->assertOk();
    }

    public function testUserUpdate()
    {
        $this->actingAs($this->task->creator)
            ->patch(route('tasks.update', $this->task), $this->goodData)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas("tasks", $this->goodData);
    }

    public function testUserDelete()
    {
        $this->actingAs($this->task->creator)
            ->delete(route('tasks.destroy', $this->task))
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertSoftDeleted("tasks", ['id' => $this->task->id]);
    }

    //Testing actions that both users and guests are able to perform

    public function testIndex()
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
    }

    public function testShow()
    {
        $response = $this->get(route('tasks.show', ['task' => $this->task]));
        $response->assertOk();
    }
}
