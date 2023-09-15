<?php

namespace Tests\Feature\Livewire\Brands;

use Tests\TestCase;
use App\Models\Brand;
use Livewire\Livewire;
use App\Http\Livewire\Brands\BrandDelete;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BrandDeleteTest extends TestCase
{
    use RefreshDatabase;

    private function newBrand()
    {
        $newBrand = Brand::create([
            'name' => 'New Brand',
            'model_id' => '1'
        ]);

        return $newBrand;
    } 
    
        

    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(BrandDelete::class);

        $component->assertStatus(200);
    }

    /** @test */
    function can_delete_brands()
    {
        $brand = $this->newBrand();

        Livewire::test('brands.brand-delete')
            ->call('delete', $brand)
            ->assertEmittedTo('brands.brand-component','render')
        ;

        $brand_delete = Brand::find($brand->id);
        $this->assertNull($brand_delete);
    }

    /** @test */
    function can_restore_brands()
    {
        // $brand = Brand::create([
        //     'name' => 'New Brand2',
        //     'model_id' => '1',
        // ]);
        $brand = $this->newBrand();

        $brand_delete = $brand->id;

        Livewire::test('brands.brand-delete')
            ->call('restore', $brand_delete)
            ->assertEmittedTo('brands.brand-component','render')
        ;

        $brand_restore = Brand::find($brand_delete);
        $this->assertNotNull($brand_restore);
    }
}
