<?php

namespace Tests\Feature;

use App\Label;
use Illuminate\Support\Arr;
use Tests\TestCase;

class LabelControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->label = factory(Label::class)->create();

        $this->goodData = Arr::only(factory(Label::class)->make()->toArray(), ['name', 'description', 'attention_level']);
        $this->badData = ['name' => '12', 'description' => '12'];
    }

    /*
     * Guest tests
     * */

    public function testGuestIndex(): void
    {
        $response = $this->get(route('labels.index'));
        $response->assertOk();
    }

    public function testGuestStore(): void
    {
        $response = $this->post(route('labels.store'), $this->goodData);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('labels', $this->goodData);
    }

    public function testGuestEdit(): void
    {
        $response = $this->get(route('labels.edit', $this->label));
        $response->assertRedirect(route('login'));
    }

    public function testGuestUpdate(): void
    {
        $response = $this->patch(route('labels.update', $this->label), $this->goodData);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('labels', $this->goodData);
    }

    public function testGuestDelete(): void
    {
        $response = $this->delete(route('labels.destroy', $this->label));

        $response->assertRedirect(route('login'));
        $this->assertDatabaseHas('labels', ['id' => $this->label->id]);
    }

    /*
     * Authenticated user tests
     * */

    public function testUserIndex(): void
    {
        $response = $this->actingAs($this->user())->get(route('labels.index'));
        $response->assertOk();
    }

    public function testUserStoreSuccess(): void
    {
        $this->actingAs($this->user())
            ->post(route('labels.store'), $this->goodData)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas('labels', $this->goodData);
    }

    public function testUserStoreFail(): void
    {
        $this->actingAs($this->user())
            ->post(route('labels.index'), $this->badData)
            ->assertSessionHasErrors()
            ->assertRedirect();
        $this->assertDatabaseMissing('labels', $this->badData);
    }

    public function testUserEditSuccess(): void
    {
        $response = $this->actingAs($this->user())->get(route('labels.edit', $this->label));
        $response->assertOk();
    }

    public function testUserUpdateSuccess(): void
    {
        $this->actingAs($this->user())
            ->patch(route('labels.update', $this->label), $this->goodData)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas("labels", $this->goodData);
    }

    public function testUserUpdateFail(): void
    {
        $this->actingAs($this->user())
            ->patch(route('labels.update', $this->label), $this->badData)
            ->assertSessionHasErrors()
            ->assertRedirect();
        $this->assertDatabaseMissing("labels", $this->badData);
    }

    public function testUserDeleteSuccess(): void
    {
        $this->actingAs($this->user())
            ->delete(route('labels.destroy', $this->label))
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertSoftDeleted("labels", ['id' => $this->label->id]);
    }
}
