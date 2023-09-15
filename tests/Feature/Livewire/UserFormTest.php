<?php

namespace Tests\Feature\Livewire;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class UserFormTest extends TestCase
{
    use RefreshDatabase;

    //* Test create users
    /** @test */
    function can_create_new_users()
    {
        Livewire::test('users.user-create')
            ->set('name', 'New usuario')
            ->set('username', 'user1')
            ->set('dni', '40434085')
            ->set('password', '12345678')
            ->call('store')
            ->assertEmittedTo('users.user-component','render');
            ;

        $this->assertDatabaseHas('users', [
            'name' => 'New usuario',
            'username' => 'user1',
            'dni' => '40434085',
        ]);
    }

    /** @test */
    function name_is_required()
    {
        Livewire::test('users.user-create')
            ->set('username', 'user1')
            ->set('dni', '40434085')
            ->set('password', '12345678')
            ->call('store')
            ->assertHasErrors(['name' => 'required'])
        ;
    }

    /** @test */
    function username_is_required()
    {
        Livewire::test('users.user-create')
            ->set('name', 'New usuario')
            ->set('dni', '40434085')
            ->set('password', '12345678')
            ->call('store')
            ->assertHasErrors(['username' => 'required'])
        ;
    }

    /** @test */
    function username_is_unique()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'username' => 'user1',
            'dni' => '10101010',
            'password' => Hash::make('12345678'),
        ]);

        Livewire::test('users.user-create')
            ->set('name', 'New usuario')
            ->set('username', 'user1')
            ->set('dni', '40434085')
            ->set('password', '12345678')
            ->call('store')
            ->assertHasErrors(['username' => 'unique:users'])
        ;
    }

    /** @test */
    function password_is_required()
    {
        Livewire::test('users.user-create')
            ->set('name', 'New usuario')
            ->set('username', 'user1')
            ->set('dni', '40434085')
            ->call('store')
            ->assertHasErrors(['password' => 'required'])
        ;
    }

    /** @test */
    function password_is_min()
    {
        Livewire::test('users.user-create')
            ->set('name', 'New usuario')
            ->set('username', 'user1')
            ->set('dni', '40434085')
            ->set('password', '1234')
            ->call('store')
            ->assertHasErrors(['password' => 'min'])
        ;
    }

    /** @test */
    function dni_is_required()
    {
        Livewire::test('users.user-create')
            ->set('name', 'New usuario')
            ->set('username', 'user1')
            ->set('password', '12345678')
            ->call('store')
            ->assertHasErrors(['dni' => 'required'])
        ;
    }

    /** @test */
    function dni_is_min()
    {
        Livewire::test('users.user-create')
            ->set('name', 'New usuario')
            ->set('username', 'user1')
            ->set('dni', '4043')
            ->set('password', '12345678')
            ->call('store')
            ->assertHasErrors(['dni' => 'min'])
        ;
    }

    //* Test edit users
    /** @test */
    function can_edit_users()
    {
        $user = User::factory()->create([
            'name' => 'New usuario',
            'username' => 'user1',
            'dni' => '40434085',
            'password' => Hash::make('12345678'),
        ]);

        Livewire::test('users.user-edit')
            ->call('edit', $user)
            ->assertSet('showModal', true)
            ->assertSet('data', $user)
            ->assertSet('name', 'New usuario')
            ->assertSet('username', 'user1')
            ->assertSet('dni', '40434085')
        ;
    }

    /** @test */
    function can_update_users()
    {

        $user = User::factory()->create([
            'name' => 'New usuario',
            'username' => 'user1',
            'dni' => '40434085',
            'password' => Hash::make('12345678'),
        ]);

        Livewire::test('users.user-edit')
            ->call('edit', $user)
            ->set('name', 'Update name')
            ->set('username', 'Update username')
            ->set('dni', 'Update dni')
            ->call('update')
            ->assertEmittedTo('users.user-component','render');
        ;

        $this->assertDatabaseCount('users', 1);

        $this->assertDatabaseHas('users', [
            'name' => 'Update name',
            'username' => 'Update username',
            'dni' => 'Update dni',
        ]);

        
    }

    //* Test delete users
    /** @test */
    function can_delete_users()
    {
        $user = User::factory()->create([
            'name' => 'New usuario',
            'username' => 'user1',
            'dni' => '40434085',
            'password' => Hash::make('12345678'),
        ]);

        Livewire::test('users.user-delete')
            ->call('delete', $user)
            ->assertEmittedTo('users.user-component','render')
        ;

        $user_delete = User::find($user->id);
        $this->assertNull($user_delete);
    }

    /** @test */
    function can_restore_users()
    {
        $user = User::factory()->create([
            'name' => 'New usuario',
            'username' => 'user1',
            'dni' => '40434085',
            'password' => Hash::make('12345678'),
        ]);

        $user_delete = $user->id;

        Livewire::test('users.user-delete')
            ->call('delete', $user)
            ->assertEmittedTo('users.user-component','render')
        ;

        Livewire::test('users.user-delete')
            ->call('restore', $user_delete)
            ->assertEmittedTo('users.user-component','render')
        ;

        $user_restore = User::find($user_delete);
        $this->assertNotNull($user_restore);
    }
}
