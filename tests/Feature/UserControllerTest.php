<?php

namespace Tests\Feature\Web;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Arr;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->goodData = Arr::only(factory(User::class)->make()->toArray(), ['name']);
        $this->badData = ['name' => ''];
    }

    //Testing actions as a guest

    public function testGuestShow()
    {
        $response = $this->get(route('users.show', $this->user));
        $response->assertRedirect(route('login'));
    }

    public function testGuestEdit()
    {
        $response = $this->get(route('users.edit', $this->user));
        $response->assertRedirect(route('login'));
    }

    public function testGuestUpdate()
    {
        $response = $this->patch(route('users.show', $this->user), $this->goodData);
        $response->assertRedirect(route('login'));
    }

    //Testing actions as a user

    public function testUserShow()
    {
        $response = $this->actingAs($this->user())->get(route('users.show', $this->user));
        $response->assertOk();
    }

    public function testUserEditFail()
    {
        $response = $this->actingAs($this->user())->get(route('users.edit', $this->user));
        $response->assertForbidden();
    }

    public function testUserEditSuccess()
    {
        $response = $this->actingAs($this->user)->get(route('users.edit', $this->user));
        $response->assertOk();
    }

    public function testUserUpdateSuccess()
    {
        $response = $this->actingAs($this->user)->patch(route('users.show', $this->user), $this->goodData);
        $response->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas("users", $this->goodData);
    }

    public function testUserUpdateFail()
    {
        $response = $this->actingAs($this->user)->patch(route('users.show', $this->user), $this->badData);
        $response->assertSessionHasErrors()
            ->assertRedirect();
        $this->assertDatabaseMissing("users", $this->badData);
    }
}
