<?php

namespace Tests\Feature\Livewire\Devices;

use App\Http\Livewire\Devices\DeviceEdit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DeviceEditTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(DeviceEdit::class);

        $component->assertStatus(200);
    }
}
