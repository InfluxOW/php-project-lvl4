<?php

namespace Tests\Feature\Guest;

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
    }

    //Testing actions as a guest

    public function testGuestStore()
    {
        $response = $this->post(route('task_statuses.store'), $this->goodData);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('task_statuses', $this->goodData);
    }

    public function testGuestEdit()
    {
        $response = $this->get(route('task_statuses.edit', $this->status));
        $response->assertRedirect(route('login'));
    }

    public function testGuestUpdate()
    {
        $response = $this->patch(route('task_statuses.update', $this->status), $this->goodData);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('task_statuses', $this->goodData);
    }

    public function testGuestDelete()
    {
        $response = $this->delete(route('task_statuses.destroy', $this->status));

        $response->assertRedirect(route('login'));
        $this->assertDatabaseHas('task_statuses', ['id' => $this->status->id]);
    }
}
