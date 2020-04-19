<?php

namespace Tests\Feature;

use App\Label;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class LabelControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->label = factory(Label::class)->create();

        $this->goodData = Arr::only(factory(Label::class)->make()->toArray(), ['name', 'description']);
        $this->badData = ['name' => '12', 'description' => '12'];
    }

    //Testing actions as a guest

    public function testGuestStore()
    {
        $response = $this->post(route('labels.store'), $this->goodData);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('labels', $this->goodData);
    }

    public function testGuestEdit()
    {
        $response = $this->get(route('labels.edit', $this->label));
        $response->assertRedirect(route('login'));
    }

    public function testGuestUpdate()
    {
        $response = $this->patch(route('labels.update', $this->label), $this->goodData);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('labels', $this->goodData);
    }

    public function testGuestDelete()
    {
        $response = $this->delete(route('labels.destroy', $this->label));

        $response->assertRedirect(route('login'));
        $this->assertDatabaseHas('labels', ['id' => $this->label->id]);
    }

    //Testing actions as a user

    public function testUserStoreSuccess()
    {
        $this->actingAs($this->user())
            ->post(route('labels.store'), $this->goodData)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas('labels', $this->goodData);
    }

    public function testUserStoreFail()
    {
        $this->actingAs($this->user())
            ->post(route('labels.index'), $this->badData)
            ->assertSessionHasErrors()
            ->assertRedirect();
        $this->assertDatabaseMissing('labels', $this->badData);
    }

    public function testUserEditSuccess()
    {
        $response = $this->actingAs($this->user())->get(route('labels.edit', $this->label));
        $response->assertOk();
    }

    public function testUserUpdateSuccess()
    {
        $this->actingAs($this->user())
            ->patch(route('labels.update', $this->label), $this->goodData)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas("labels", $this->goodData);
    }

    public function testUserUpdateFail()
    {
        $this->actingAs($this->user())
            ->patch(route('labels.update', $this->label), $this->badData)
            ->assertSessionHasErrors()
            ->assertRedirect();
        $this->assertDatabaseMissing("labels", $this->badData);
    }

    public function testUserDeleteSuccess()
    {
        $this->actingAs($this->user())
            ->delete(route('labels.destroy', $this->label))
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertSoftDeleted("labels", ['id' => $this->label->id]);
    }

    //Testing actions that both users and guests are able to perform

    public function testIndex()
    {
        $response = $this->get(route('labels.index'));
        $response->assertOk();
    }
}
