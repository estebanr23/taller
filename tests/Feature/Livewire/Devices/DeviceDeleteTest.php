<?php

namespace Tests\Feature\Livewire\Devices;

use App\Http\Livewire\Devices\DeviceDelete;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DeviceDeleteTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(DeviceDelete::class);

        $component->assertStatus(200);
    }
}
