<?php

namespace Tests\Feature\Guest;

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
}
