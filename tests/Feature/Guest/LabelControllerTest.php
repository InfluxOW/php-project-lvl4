<?php

namespace Tests\Feature\Guest;

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
}
