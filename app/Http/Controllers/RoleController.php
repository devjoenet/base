<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Permissions\GetPermissionsList;
use App\Data\RoleData;
use Exception;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('roles/Index', [
            'roles' => Role::withCount('permissions')
                ->orderBy('name')
                ->paginate(10)
                ->through(fn (Role $role): array => [
                    'id' => $role->id,
                    'name' => $role->name,
                    'permissions_count' => $role->permissions_count,
                    'created_at' => $role->created_at->format('M d, Y'),
                ]),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('roles/Create', [
            'permissions' => new GetPermissionsList()(),
        ]);
    }

    public function store(RoleData $data): RedirectResponse
    {
        $role = Role::create(['name' => $data->name]);

        if ($data->permissions !== []) {
            $role->syncPermissions($data->permissions);
        }

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role created successfully.');
    }

    public function edit(Role $role): Response
    {
        // Eager load permissions to check checkboxes
        $role->load('permissions');

        return Inertia::render('roles/Edit', [
            'role' => [
                'id' => $role->id,
                'name' => $role->name,
                'permissions' => $role->permissions->pluck('name'),
            ],
            'permissions' => Permission::orderBy('name')->pluck('name'),
        ]);
    }

    public function update(Role $role, RoleData $data): RedirectResponse
    {
        $role->update(['name' => $data->name]);

        $role->syncPermissions($data->permissions);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        try {
            if (in_array($role->name, ['admin', 'user', 'super-admin'])) {
                throw new Exception('Base system roles can not be deleted.');
            }

            $role->delete();

            return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
}
