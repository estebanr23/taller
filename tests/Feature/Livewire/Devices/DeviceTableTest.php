<?php

namespace Tests\Feature\Livewire\Devices;

use App\Http\Livewire\Devices\DeviceTable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DeviceTableTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(DeviceTable::class);

        $component->assertStatus(200);
    }
}
