<?php

namespace Tests\Feature\Livewire\Brands;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\Brands\BrandCreate;
use App\Http\Livewire\Brands\BrandTable;
use App\Models\ModelDevice;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BrandTableTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(BrandTable::class);

        $component->assertStatus(200);
    }
}
