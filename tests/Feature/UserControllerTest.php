<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Arr;

class UserControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->goodData = Arr::only(factory(User::class)->make()->toArray(), ['name']);
    }

    //Testing actions as a user

    public function testUserShow()
    {
        $response = $this->actingAs($this->user)->get(route('users.show', $this->user));
        $response->assertOk();
    }

    public function testUserEdit()
    {
        $response = $this->actingAs($this->user)->get(route('users.edit', $this->user));
        $response->assertOk();
    }

    public function testUserUpdate()
    {
        $response = $this->actingAs($this->user)->patch(route('users.show', $this->user), $this->goodData);
        $response->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas("users", $this->goodData);
    }
}
