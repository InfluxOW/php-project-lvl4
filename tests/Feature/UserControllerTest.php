<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Arr;

class UserControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->goodData = Arr::only(factory(User::class)->make()->toArray(), ['name']);
        $this->badData = ['name' => ''];
    }

    /*
     * Guest tests
     * */

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

    /*
     * Authenticated user tests
     * */

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
