<?php

declare(strict_types=1);

use App\Models\User;
use Spatie\Permission\Models\Permission;

test('permissions index page is displayed', function () {
    $user = User::factory()->create();
    Permission::firstOrCreate(['name' => 'manage permissions']);
    $user->givePermissionTo('manage permissions');

    $response = $this->actingAs($user)->get(route('permissions.index'));

    $response->assertStatus(200);
});

test('create permission page is displayed', function () {
    $user = User::factory()->create();
    Permission::firstOrCreate(['name' => 'manage permissions']);
    $user->givePermissionTo('manage permissions');

    $response = $this->actingAs($user)->get(route('permissions.create'));

    $response->assertStatus(200);
});

test('can create a permission', function () {
    $user = User::factory()->create();
    Permission::firstOrCreate(['name' => 'manage permissions']);
    $user->givePermissionTo('manage permissions');

    $response = $this->actingAs($user)->post(route('permissions.store'), [
        'name' => 'new permission',
        'guard_name' => 'web',
    ]);

    $response->assertRedirect(route('permissions.index'));
    $this->assertDatabaseHas('permissions', ['name' => 'new permission']);
});

test('edit permission page is displayed', function () {
    $user = User::factory()->create();
    Permission::firstOrCreate(['name' => 'manage permissions']);
    $user->givePermissionTo('manage permissions');
    $permission = Permission::firstOrCreate(['name' => 'test-permission']);

    $response = $this->actingAs($user)->get(route('permissions.edit', $permission));

    $response->assertStatus(200);
});

test('can update a permission', function () {
    $user = User::factory()->create();
    Permission::firstOrCreate(['name' => 'manage permissions']);
    $user->givePermissionTo('manage permissions');
    $permission = Permission::firstOrCreate(['name' => 'test-permission']);

    $response = $this->actingAs($user)->put(route('permissions.update', $permission), [
        'name' => 'updated-permission',
        'guard_name' => 'web',
    ]);

    $response->assertRedirect(route('permissions.index'));
    $this->assertDatabaseHas('permissions', ['name' => 'updated-permission']);
});
