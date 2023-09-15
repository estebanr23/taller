<?php

namespace Tests\Feature\Livewire\TypeDevices;

use App\Http\Livewire\TypeDevices\TypeDevicesTable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TypeDevicesTableTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(TypeDevicesTable::class);

        $component->assertStatus(200);
    }
}
