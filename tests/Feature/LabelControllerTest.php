<?php

namespace Tests\Feature;

use App\Label;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class LabelControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->label = factory(Label::class)->create();
        $this->goodData = Arr::only(factory(Label::class)->make()->toArray(), ['name', 'description']);
    }
    //Testing actions as a user

    public function testUserStore()
    {
        $this->actingAs($this->user())
            ->post(route('labels.store'), $this->goodData)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas('labels', $this->goodData);
    }

    public function testUserEdit()
    {
        $response = $this->actingAs($this->user())->get(route('labels.edit', $this->label));
        $response->assertOk();
    }

    public function testUserUpdate()
    {
        $this->actingAs($this->user())
            ->patch(route('labels.update', $this->label), $this->goodData)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas("labels", $this->goodData);
    }

    public function testUserDelete()
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
