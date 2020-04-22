<?php

namespace Tests\Feature\Guest;

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

    //Testing actions as a guest

    public function testGuestStore()
    {
        $response = $this->post(route('tasks.store'), $this->goodData);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('tasks', $this->goodData);
    }

    public function testGuestEdit()
    {
        $response = $this->get(route('tasks.edit', $this->task));
        $response->assertRedirect(route('login'));
    }

    public function testGuestUpdate()
    {
        $response = $this->patch(route('tasks.update', $this->task), $this->goodData);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('tasks', $this->goodData);
    }

    public function testGuestDelete()
    {
        $response = $this->delete(route('tasks.destroy', $this->task));

        $response->assertRedirect(route('login'));
        $this->assertDatabaseHas('tasks', ['id' => $this->task->id, 'name' => $this->task->name]);
    }
}
