<?php

namespace Tests\Feature\Livewire;

use App\Models\Area;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AreaFormTest extends TestCase
{
    use RefreshDatabase;
    
    //* Test create users
    
    /** @test */
    function can_create_new_areas()
    {
        Livewire::test('areas.area-create')
            ->set('name', 'New area')
            ->call('store')
            ->assertEmittedTo('areas.area-component','render');
            ;

        $this->assertDatabaseHas('areas', [
            'name' => 'New area',
        ]);
    }

    /** @test */
    function name_area_is_required()
    {
        Livewire::test('areas.area-create')
            ->call('store')
            ->assertHasErrors(['name' => 'required'])
            ;
    }

    /** @test */
    function name_area_is_unique()
    {
        $area = Area::create(["name" => "New area"]);

        Livewire::test('areas.area-create')
            ->set('name', 'New area')
            ->call('store')
            ->assertHasErrors(['name' => 'unique'])
            ;
    }

    //* Test edit areas

    /** @test */
    function can_edit_areas()
    {
        $area = Area::create(["name" => "New area"]);

        Livewire::test('areas.area-edit')
            ->call('edit', $area)
            ->assertSet('data', $area)
            ->assertSet('name', $area->name)
            ->assertSet('showModal', true)
            ;

    }

    /** @test */
    function can_update_areas()
    {
        $area = Area::create(["name" => "New area"]);

        Livewire::test('areas.area-edit')
            ->call('edit', $area)
            ->set('name', 'Edit area')
            ->call('update')
            ->assertSet('name', '')
            ->assertEmittedTo('areas.area-component','render');
            ;

        $this->assertDatabaseHas('areas', [
            'name' => 'Edit area',
        ]);
    }

    //* Test delete areas

    /** @test */
    function can_delete_areas()
    {
        $area = Area::create([
            'name' => 'New area',
        ]);

        Livewire::test('areas.area-delete')
            ->call('delete', $area)
            ->assertEmittedTo('areas.area-component','render')
        ;

        $area_delete = Area::find($area->id);
        $this->assertNull($area_delete);
    }

    /** @test */
    function can_restore_areas()
    {
        $area = Area::create([
            'name' => 'New area',
        ]);

        $area->delete();

        Livewire::test('areas.area-delete')
            ->call('restore', $area->id)
            ->assertEmittedTo('areas.area-component','render')
        ;

        $area_restore = Area::find($area->id);
        $this->assertNotNull($area_restore);
    }
}
