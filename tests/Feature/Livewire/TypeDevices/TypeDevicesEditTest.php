<?php

namespace Tests\Feature\Livewire\TypeDevices;

use App\Http\Livewire\TypeDevices\TypeDevicesEdit;
use App\Models\TypeDevice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TypeDevicesEditTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(TypeDevicesEdit::class);

        $component->assertStatus(200);
    }

    /** @test */
    public function can_update_type_devices()
    {
        $type = TypeDevice::create([
            'name' => 'New Type Device'
        ]);

        Livewire::test(TypeDevicesEdit::class)
                ->call('edit', $type)
                ->set('name', 'Type Device Updated')
                ->call('update')
                ->assertEmittedTo('type-devices.type-devices-table','updated')
                ->assertEmittedTo('type-devices.type-devices-table','render');
        
        $this->assertDatabaseCount('type_devices', 1);

        $this->assertDatabaseHas('type_devices', [
            'name' => 'Type Device Updated'
        ]);
    }
}
