<?php

namespace Tests\Feature\Livewire\Brands;

use Tests\TestCase;
use App\Models\User;
use App\Models\Brand;
use Livewire\Livewire;
use App\Models\ModelDevice;
use App\Http\Livewire\Brands\BrandTable;
use App\Http\Livewire\Brands\BrandCreate;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BrandCreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(BrandCreate::class);

        $component->assertStatus(200);
    }

    /** @test */
    function can_create_brand()
    {
        $this->actingAs(User::factory()->create());
 
        Livewire::test(BrandCreate::class)
            ->set('name', 'Brand Name')
            ->call('store')
            ->assertSet('showModal', false)
            ->assertEmittedTo(BrandTable::class, 'render');

        $this->assertDatabaseHas('brands', [
            'name' => 'Brand Name'
        ]);
    }

    /** @test */
    function name_brand_is_required()
    {
        Livewire::test(BrandCreate::class)
            ->call('store')
            ->assertHasErrors(['name' => 'required'])
        ;
    }

    /** @test */
    function name_brand_must_be_unique()
    {
        Brand::create([
            'name' => 'New Brand',
        ]);

        Livewire::test(BrandCreate::class)
            ->set('name', 'New Brand')
            ->call('store')
            ->assertHasErrors(['name' => 'unique:brands'])
        ;
    }
}
