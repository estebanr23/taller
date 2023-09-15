<?php

namespace Tests\Feature\Livewire;

use App\Models\Area;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    //* Test create customers

    /** @test */
    function can_create_new_customers()
    {
        $area = Area::create(["name" => "Area de prueba"]);

        Livewire::test('customers.customer-create')
            ->set('name', 'New customer')
            ->set('dni', '40434678')
            ->set('phone', '3834125689')
            ->set('file_number', '1223')
            ->set('area_id', $area->id)
            ->call('store')
            ->assertEmittedTo('customers.customer-component','render');
        ;

        $this->assertDatabaseHas('customers', [
            'name' => 'New customer',
            'dni' => '40434678',
            'phone' => '3834125689',
            'file_number' => '1223',
            'area_id' => $area->id,
        ]);
    }

    /** @test */
    function name_is_required_customer()
    {
        $area = Area::create(["name" => "Area de prueba"]);

        Livewire::test('customers.customer-create')
            ->set('dni', '40434678')
            ->set('phone', '3834125689')
            ->set('file_number', '1223')
            ->set('area_id', $area->id)
            ->call('store')
            ->assertHasErrors(["name" => "required"])
            ;
    }

    /** @test */
    function dni_is_required_customer()
    {
        $area = Area::create(["name" => "Area de prueba"]);

        Livewire::test('customers.customer-create')
            ->set('name', 'New customer')
            ->set('phone', '3834125689')
            ->set('file_number', '1223')
            ->set('area_id', $area->id)
            ->call('store')
            ->assertHasErrors(["dni" => "required"])
            ;
    }

    /** @test */
    function dni_is_min_customer()
    {
        $area = Area::create(["name" => "Area de prueba"]);

        Livewire::test('customers.customer-create')
            ->set('name', 'New customer')
            ->set('dni', '4047')
            ->set('phone', '3834125689')
            ->set('file_number', '1223')
            ->set('area_id', $area->id)
            ->call('store')
            ->assertHasErrors(["dni" => "min"])
        ;
    }

    /** @test */
    function dni_is_unique_customer()
    {
        $area = Area::create(["name" => "Area de prueba"]);

        Livewire::test('customers.customer-create')
            ->set('name', 'New customer')
            ->set('dni', '40434678')
            ->set('phone', '3834125689')
            ->set('file_number', '1223')
            ->set('area_id', $area->id)
            ->call('store')
        ;

        Livewire::test('customers.customer-create')
            ->set('name', 'New customer1')
            ->set('dni', '40434678')
            ->set('phone', '3834120032')
            ->set('file_number', '1245')
            ->set('area_id', $area->id)
            ->call('store')
            ->assertHasErrors(["dni" => "unique"])
        ;
    }

    /** @test */
    function phone_is_min_customer()
    {
        $area = Area::create(["name" => "Area de prueba"]);

        Livewire::test('customers.customer-create')
            ->set('name', 'New customer')
            ->set('dni', '40434678')
            ->set('phone', '383')
            ->set('file_number', '1223')
            ->set('area_id', $area->id)
            ->call('store')
            ->assertHasErrors(["phone" => "min"])
        ;
    }

    /** @test */
    function phone_is_nullable_customer()
    {
        $area = Area::create(["name" => "Area de prueba"]);

        Livewire::test('customers.customer-create')
            ->set('name', 'New customer')
            ->set('dni', '40434678')
            ->set('file_number', '1223')
            ->set('area_id', $area->id)
            ->call('store')
        ;

        $this->assertDatabaseHas('customers', [
            'name' => 'New customer',
            'dni' => '40434678',
            'phone' => null,
            'file_number' => '1223',
            'area_id' => $area->id,
        ]);
    }

    /** @test */
    function file_number_is_unique_customer()
    {
        $area = Area::create(["name" => "Area de prueba"]);

        Livewire::test('customers.customer-create')
            ->set('name', 'New customer')
            ->set('dni', '40434678')
            ->set('phone', '3834125689')
            ->set('file_number', '1223')
            ->set('area_id', $area->id)
            ->call('store')
        ;

        Livewire::test('customers.customer-create')
            ->set('name', 'New customer1')
            ->set('dni', '40430033')
            ->set('phone', '3834120032')
            ->set('file_number', '1223')
            ->set('area_id', $area->id)
            ->call('store')
            ->assertHasErrors(["file_number" => "unique"])
        ;
    }

    /** @test */
    function file_number_is_nullable_customer()
    {
        $area = Area::create(["name" => "Area de prueba"]);

        Livewire::test('customers.customer-create')
            ->set('name', 'New customer')
            ->set('dni', '40434678')
            ->set('phone', '3834125689')
            ->set('area_id', $area->id)
            ->call('store')
        ;

        $this->assertDatabaseHas('customers', [
            'name' => 'New customer',
            'dni' => '40434678',
            'phone' => '3834125689',
            'file_number' => null,
            'area_id' => $area->id,
        ]);
    }

    /** @test */
    function area_is_required_customer()
    {
        Livewire::test('customers.customer-create')
            ->set('name', 'New customer')
            ->set('dni', '40434678')
            ->set('phone', '3834125689')
            ->call('store')
            ->assertHasErrors(["area_id" => "required"])
        ;
    }

    //* Test edit customers

    /** @test */
    function can_edit_customers()
    {
        $area = Area::create(["name" => "Area de prueba"]);

        $customer = Customer::create([
            "name" => "New customer",
            "dni" => "12457832",
            "phone" => "3834126598",
            "file_number" => "1315",
            "area_id" => $area->id
        ]);

        Livewire::test('customers.customer-edit')
            ->call('edit', $customer)
            ->assertSet('data', $customer)
            ->assertSet('name', $customer->name)
            ->assertSet('dni', $customer->dni)
            ->assertSet('phone', $customer->phone)
            ->assertSet('file_number', $customer->file_number)
            ->assertSet('area_id', $customer->area_id)
            ->assertSet('showModal', true)
        ;
    }

    /** @test */
    function can_update_customers()
    {
        $area = Area::create(["name" => "Area de prueba"]);

        $customer = Customer::create([
            "name" => "New customer",
            "dni" => "12457832",
            "phone" => "3834126598",
            "file_number" => "1315",
            "area_id" => $area->id
        ]);

        Livewire::test('customers.customer-edit')
            ->call('edit', $customer)
            ->set('name', 'Edit customer')
            ->set('dni', '00014110')
            ->set('phone', '3834002200')
            ->set('file_number', '0003')
            ->set('area_id', $area->id)
            ->call('update')
        ;

        $this->assertDatabaseHas('customers', [
            "name" => "Edit customer",
            "dni" => "00014110",
            "phone" => "3834002200",
            "file_number" => "0003",
            "area_id" => $area->id
        ]);
    }

    //* Test delete customers

    /** @test */
    function can_delete_customers()
    {
        $area = Area::create(["name" => "Area de prueba"]);

        $customer = Customer::create([
            "name" => "New customer",
            "dni" => "12457832",
            "phone" => "3834126598",
            "file_number" => "1315",
            "area_id" => $area->id
        ]);

        Livewire::test('customers.customer-delete')
            ->call('delete', $customer)
            ->assertEmittedTo('customers.customer-component','render')
        ;

        $customer_delete = Customer::find($customer->id);
        $this->assertNull($customer_delete);
    }

    /** @test */
    function can_restore_customers()
    {
        $area = Area::create(["name" => "Area de prueba"]);

        $customer = Customer::create([
            "name" => "New customer",
            "dni" => "12457832",
            "phone" => "3834126598",
            "file_number" => "1315",
            "area_id" => $area->id
        ]);

        $customer_delete = $customer->id;

        Livewire::test('customers.customer-delete')
            ->call('delete', $customer)
            ->assertEmittedTo('customers.customer-component','render')
        ;

        Livewire::test('customers.customer-delete')
            ->call('restore', $customer_delete)
            ->assertEmittedTo('customers.customer-component','render')
        ;

        $customer_restore = Customer::find($customer_delete);
        $this->assertNotNull($customer_restore);
    }
}
