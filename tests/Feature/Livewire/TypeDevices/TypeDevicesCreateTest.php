<?php

namespace Tests\Feature\Livewire\TypeDevices;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Livewire\TypeDevices\TypeDevicesCreate;

class TypeDevicesCreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(TypeDevicesCreate::class);

        $component->assertStatus(200);
    }

    /** @test */
    function can_create_type_devices()
    {
        $this->actingAs(User::factory()->create());
 
        Livewire::test(TypeDevicesCreate::class)
            ->set('name', 'Type Devices Name')
            ->call('create')
            ->assertSet('showModal', false)
            ->assertEmittedTo(TypeDevicesCreate::class, 'render');

        $this->assertDatabaseHas('type_devices', [
            'name' => 'Type Devices Name'
        ]);
    }

    /** @test */
    function name_brand_is_required()
    {
        Livewire::test(TypeDevicesCreate::class)
            ->call('create')
            ->assertHasErrors(['name' => 'required'])
        ;
    }
}
