<?php

namespace Tests\Feature\Livewire;

use Tests\TestCase;
use App\Models\Brand;
use Livewire\Livewire;
use App\Models\ModelDevice;
use App\Http\Livewire\Models\ModelEdit;
use App\Http\Livewire\Models\ModelDelete;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModelDeviceTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    function can_create_new_model_device()
    {
        $brandName = $this->faker->name;
        $modelName = $this->faker->name;

        $brand = Brand::create([
            'name' => $brandName
        ]);

        Livewire::test('models.model-create')
            ->set('name', $modelName)
            ->set('brand_id', $brand->id)
            ->call('store')
            ->assertEmittedTo('models.model-table','render');

        $this->assertDatabaseHas('models', [
            'name' => $modelName,
            'brand_id' => $brand->id
        ]);
    }

    /** @test */
    function name_model_is_required()
    {
        Livewire::test('models.model-create')
            ->call('store')
            ->assertHasErrors(['name' => 'required'])
        ;
    }

    /** @test */
    function name_model_is_unique()
    {
        ModelDevice::create([
            'name' => 'Test Model Device'
        ]);

        Livewire::test('models.model-create')
            ->set('name', 'Test Model Device')
            ->call('store')
            ->assertHasErrors(['name' => 'unique:models'])
        ;
    }

    /** @test */
    function can_edit_models_device()
    {
        $model = ModelDevice::create([
            'name' => 'Model Device Edit'
        ]);

        Livewire::test(ModelEdit::class)
            ->call('edit', $model)
            ->assertSet('showModal', true)
            ->assertSet('data', $model)
            ->assertSet('name', 'Model Device Edit');
    }

    /** @test */
    function can_update_models_device()
    {

        $model = ModelDevice::create([
            'name' => 'New usuario'
        ]);

        Livewire::test(ModelEdit::class)
            ->call('edit', $model)
            ->set('name', 'Update name')
            ->call('update')
            ->assertEmittedTo('models.model-table','render');
        ;

        $this->assertDatabaseCount('models', 1);

        $this->assertDatabaseHas('models', [
            'name' => 'Update name'
        ]);
    }

    /** @test */
    function can_delete_models_device()
    {
        $model = ModelDevice::create([
            'name' => 'New Model Device'
        ]);

        Livewire::test(ModelDelete::class)
            ->call('delete', $model)
            ->assertEmittedTo('models.model-table','render')
        ;

        $model_delete = ModelDevice::find($model->id);
        $this->assertNull($model_delete);
    }

    /** @test */
    function can_restore_models_device()
    {
        $model = ModelDevice::create([
            'name' => 'New Model'
        ]);

        $model_delete = $model->id;

        Livewire::test(ModelDelete::class)
            ->call('delete', $model)
            ->assertEmittedTo('models.model-table','render')
        ;

        Livewire::test(ModelDelete::class)
            ->call('restore', $model_delete)
            ->assertEmittedTo('models.model-table','render')
        ;

        $model_restore = ModelDevice::find($model_delete);
        $this->assertNotNull($model_restore);
    }

    /** @test */
    function brand_id_model_is_required()
    {
        Livewire::test(BrandCreate::class)
            ->set('name', 'New Model')
            ->call('create')
            ->assertHasErrors(['brand_id' => 'required'])
        ;
    }
}
