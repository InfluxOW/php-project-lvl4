<?php

namespace Tests\Feature;

use App\Label;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LabelControllerTest extends TestCase
{
    use RefreshDatabase;

    //Testing actions as a guest

    public function testGuestStore()
    {
        $params = ['name' => 'test name', 'description' => 'test description'];
        $response = $this->post(route('labels.store'), $params);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('labels', $params);
    }

    public function testGuestUpdate()
    {
        $label = $this->createTestLabel();
        $editedParams = ['name' => 'test name', 'description' => 'test description'];
        $response = $this->patch(route('labels.update', $label), $editedParams);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('labels', $editedParams);
    }

    public function testGuestDelete()
    {
        $label = $this->createTestLabel();
        $response = $this->delete(route('labels.destroy', $label));

        $response->assertRedirect(route('login'));
        $this->assertDatabaseHas('labels', ['id' => $label->id, 'name' => $label->name]);
    }

    //Testing actions as a user

    public function testUserStoreSuccess()
    {
        $params = ['name' => 'test name', 'description' => 'test description'];
        $this->actingAs($this->user())
            ->post(route('labels.store'), $params)
            ->assertStatus(302)
            ->assertSessionHasNoErrors();
        $this->assertDatabaseHas('labels', $params);
    }

    public function testUserStoreFail()
    {
        $params = ['name' => str_repeat('test', 20), 'description' => 'test description'];
        $this->actingAs($this->user())
            ->post(route('labels.index'), $params)
            ->assertStatus(302)
            ->assertSessionHasErrors();
        $this->assertDatabaseMissing('labels', $params);
    }

    public function testUserUpdateSuccess()
    {
        $label = $this->createTestLabel();

        $editedParams = ['name' => 'edited test name', 'description' => 'test description'];
        $this->actingAs($this->user())
            ->patch(route('labels.update', $label), $editedParams)
            ->assertStatus(302)
            ->assertSessionHasNoErrors();
        $this->assertDatabaseHas("labels", $editedParams);
    }

    public function testUserUpdateFail()
    {
        $label = $this->createTestLabel();

        $editedParams = ['name' => '12', 'description' => 'test description'];
        $this->actingAs($this->user())
            ->patch(route('labels.update', $label), $editedParams)
            ->assertStatus(302)
            ->assertSessionHasErrors();
        $this->assertDatabaseMissing("labels", $editedParams);
    }

    public function testUserDeleteSuccess()
    {
        $label = $this->createTestLabel();
        $this->assertDatabaseHas("labels", ['id' => $label->id]);

        $this->actingAs($this->user())
            ->delete(route('labels.destroy', $label))
            ->assertStatus(302)
            ->assertSessionHasNoErrors();
        $this->assertSoftDeleted("labels", ['id' => $label->id]);
    }

    //Testing actions that both users and guests are able to perform

    public function testIndex()
    {
        $this->createTestLabel();
        $response = $this->get(route('labels.index'));
        $response->assertStatus(200);
    }

    //Helpers

    private function createTestLabel()
    {
        return factory(Label::class)->create();
    }
}
