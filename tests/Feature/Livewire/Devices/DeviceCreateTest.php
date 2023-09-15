<?php

namespace Tests\Feature\Livewire\Devices;

use App\Http\Livewire\Devices\DeviceCreate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DeviceCreateTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(DeviceCreate::class);

        $component->assertStatus(200);
    }
}
