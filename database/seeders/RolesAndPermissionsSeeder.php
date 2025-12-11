<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        // Define your app-specific permissions here
        $permissions = [
            'view dashboard',
            'manage users',
            'edit profile',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create Roles and assign created permissions

        // Role: User (Default)
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo([
            'view dashboard',
            'edit profile',
        ]);

        // Role: Admin
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo($permissions); // Admin gets all defined permissions

        // Role: Super-Admin
        // This role bypasses all checks via Gate::before rule usually,
        // but explicit assignment is also good for clarity.
        $superAdminRole = Role::create(['name' => 'super-admin']);
        // Super admin gets everything implicitly or explicitly
    }
}
