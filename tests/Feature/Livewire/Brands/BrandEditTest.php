<?php

namespace Tests\Feature\Livewire\Brands;

use Tests\TestCase;
use App\Models\Brand;
use App\Models\ModelDevice;
use Livewire\Livewire;
use App\Http\Livewire\Brands\BrandEdit;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BrandEditTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(BrandEdit::class);

        $component->assertStatus(200);
    }

    /** @test */
    public function can_update_brands()
    {
        $brand = Brand::create([
            'name' => 'New brand',
        ]);

        Livewire::test(BrandEdit::class)
                ->call('edit', $brand)
                ->set('name', 'Name Brand Updated')
                ->call('update')
                ->assertEmittedTo('brands.brand-table','notification')
                ->assertEmittedTo('brands.brand-table','render');
        
        $this->assertDatabaseCount('brands', 1);

        $this->assertDatabaseHas('brands', [
            'name' => 'Name Brand Updated'
        ]);
    }

    /** @test */
    function name_brand_is_required()
    {
        $brand = Brand::create([
            'name' => 'New brand',
        ]);

        Livewire::test(BrandEdit::class)
            ->call('edit', $brand)
            ->set('name', $brand->name)
            ->call('update')
            ->assertHasNoErrors(['name' => 'required'])
        ;
    }

    /** @test */
    function name_brand_must_be_unique()
    {
        $brand = Brand::create([
            'name' => 'New Brand'
        ]);

        Livewire::test(BrandEdit::class)
            ->call('edit', $brand)
            ->set('name', $brand->name)
            ->call('update')
            ->assertHasErrors(['name' => 'unique:brands'])
        ;
    }
}
