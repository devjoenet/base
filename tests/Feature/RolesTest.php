<?php

declare(strict_types=1);

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

test('roles index page is displayed', function () {
    $user = User::factory()->create();
    Permission::firstOrCreate(['name' => 'manage roles']);
    $user->givePermissionTo('manage roles');

    $response = $this->actingAs($user)->get(route('roles.index'));

    $response->assertStatus(200);
});

test('create role page is displayed', function () {
    $user = User::factory()->create();
    Permission::firstOrCreate(['name' => 'manage roles']);
    $user->givePermissionTo('manage roles');

    $response = $this->actingAs($user)->get(route('roles.create'));

    $response->assertStatus(200);
});

test('can create a role', function () {
    $user = User::factory()->create();
    Permission::firstOrCreate(['name' => 'manage roles']);
    $user->givePermissionTo('manage roles');
    Permission::firstOrCreate(['name' => 'test permission']);

    $response = $this->actingAs($user)->post(route('roles.store'), [
        'name' => 'new role',
        'permissions' => ['test permission'],
    ]);

    $response->assertRedirect(route('roles.index'));
    $this->assertDatabaseHas('roles', ['name' => 'new role']);
});

test('edit role page is displayed', function () {
    $user = User::factory()->create();
    Permission::firstOrCreate(['name' => 'manage roles']);
    $user->givePermissionTo('manage roles');
    $role = Role::firstOrCreate(['name' => 'test-role']);

    $response = $this->actingAs($user)->get(route('roles.edit', $role));

    $response->assertStatus(200);
});

test('can update a role', function () {
    $user = User::factory()->create();
    Permission::firstOrCreate(['name' => 'manage roles']);
    $user->givePermissionTo('manage roles');
    $role = Role::firstOrCreate(['name' => 'test-role']);
    Permission::firstOrCreate(['name' => 'test permission']);

    $response = $this->actingAs($user)->put(route('roles.update', $role), [
        'name' => 'updated-role',
        'permissions' => ['test permission'],
    ]);

    $response->assertRedirect(route('roles.index'));
    $this->assertDatabaseHas('roles', ['name' => 'updated-role']);
});
