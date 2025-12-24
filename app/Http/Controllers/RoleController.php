<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Permissions\GetPermissionsList;
use App\Actions\Roles\StoreRoleAction;
use App\Actions\Roles\UpdateRoleAction;
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
            'roles' => RoleData::collect(
                Role::withCount('permissions')
                    ->orderBy('name')
                    ->paginate(10)
            ),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('roles/Create', [
            'permissions' => new GetPermissionsList()(),
        ]);
    }

    public function store(RoleData $data, StoreRoleAction $action): RedirectResponse
    {
        $action->execute($data);

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role created successfully.');
    }

    public function edit(Role $role): Response
    {
        $role->load('permissions');

        return Inertia::render('roles/Edit', [
            'role' => RoleData::from($role),
            'permissions' => Permission::orderBy('name')->pluck('name'),
        ]);
    }

    public function update(Role $role, RoleData $data, UpdateRoleAction $action): RedirectResponse
    {
        $action->execute($role, $data);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role): RedirectResponse
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
