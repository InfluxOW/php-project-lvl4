<?php

namespace Tests\Feature;

use App\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Arr;
use Tests\TestCase;

class StatusControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->status = factory(Status::class)->create();

        $this->goodData = Arr::only(factory(Status::class)->make()->toArray(), ['name']);
        $this->badData = ['name' => '12'];
    }

    //Testing actions as a user

    public function testUserStoreSuccess()
    {
        $this->actingAs($this->user())
            ->post(route('statuses.store'), $this->goodData)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas('statuses', $this->goodData);
    }

    public function testUserStoreFail()
    {
        $this->actingAs($this->user())
            ->post(route('statuses.index'), $this->badData)
            ->assertSessionHasErrors()
            ->assertRedirect();
        $this->assertDatabaseMissing('statuses', $this->badData);
    }

    public function testUserEditSuccess()
    {
        $response = $this->actingAs($this->user())->get(route('statuses.edit', $this->status));
        $response->assertOk();
    }

    public function testUserUpdateSuccess()
    {
        $this->actingAs($this->user())
            ->patch(route('statuses.update', $this->status), $this->goodData)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas("statuses", $this->goodData);
    }

    public function testUserUpdateFail()
    {
        $this->actingAs($this->user())
            ->patch(route('statuses.update', $this->status), $this->badData)
            ->assertSessionHasErrors()
            ->assertRedirect();
        $this->assertDatabaseMissing("statuses", $this->badData);
    }

    public function testUserDeleteSuccess()
    {
        $this->actingAs($this->user())
            ->delete(route('statuses.destroy', $this->status))
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertSoftDeleted("statuses", ['id' => $this->status->id]);
    }

    //Testing actions that both users and guests are able to perform

    public function testIndex()
    {
        $response = $this->get(route('statuses.index'));
        $response->assertOk();
    }
}
