<?php

namespace Tests\Feature;

use App\Label;
use App\Status;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        factory(User::class, 10)->create();
        factory(Label::class, 10)->create();
        factory(Status::class)->states('new')->create();

        $this->task = factory(Task::class)->create();
        $this->goodData = Arr::only(factory(Task::class)->make()->toArray(), ['name', 'description']);
        $this->badData = ['name' => '12', 'description' => str_repeat('too long description', 50)];
    }

    //Testing actions as a guest

    public function testGuestStore()
    {
        $params = ['name' => 'test name'];
        $response = $this->post(route('tasks.store'), $params);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('tasks', $params);
    }

    public function testGuestEdit()
    {
        $response = $this->get(route('tasks.edit', $this->task));
        $response->assertRedirect(route('login'));
    }

    public function testGuestUpdate()
    {
        $editedParams = ['name' => 'test name'];
        $response = $this->patch(route('tasks.update', $this->task), $editedParams);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('tasks', $editedParams);
    }

    public function testGuestDelete()
    {
        $response = $this->delete(route('tasks.destroy', $this->task));

        $response->assertRedirect(route('login'));
        $this->assertDatabaseHas('tasks', ['id' => $this->task->id, 'name' => $this->task->name]);
    }

    //Testing actions as a user

    public function testUserStoreSuccess()
    {
        $this->actingAs($this->user())
            ->post(route('tasks.store'), $this->goodData)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas('tasks', $this->goodData);
    }

    public function testUserStoreFail()
    {
        $this->actingAs($this->user())
            ->post(route('tasks.index'), $this->badData)
            ->assertSessionHasErrors()
            ->assertRedirect();
        $this->assertDatabaseMissing('tasks', $this->badData);
    }

    public function testUserEditSuccess()
    {
        $response = $this->actingAs($this->user())->get(route('labels.edit', $this->task));
        $response->assertOk();
    }

    public function testUserUpdateSuccess()
    {
        $this->actingAs($this->task->creator)
            ->patch(route('tasks.update', $this->task), $this->goodData)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas("tasks", $this->goodData);
    }

    public function testUserUpdateFail()
    {
        $this->actingAs($this->task->creator)
            ->patch(route('tasks.update', $this->task), $this->badData)
            ->assertSessionHasErrors()
            ->assertRedirect();
        $this->assertDatabaseMissing("tasks", $this->badData);
    }

    public function testUserDeleteFail()
    {
        $this->actingAs($this->user())
            ->delete(route('tasks.destroy', $this->task))
            ->assertForbidden();
        $this->assertDatabaseHas("tasks", ['id' => $this->task->id]);
    }

    public function testUserDeleteSuccess()
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
