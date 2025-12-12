<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Role\CreateRole;
use App\Actions\Role\DeleteRole;
use App\Actions\Role\UpdateRole;
use App\DataTransferObjects\RoleDTO;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use Exception;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): Response
    {
        $roles = Role::withCount('permissions')
            ->orderBy('name')
            ->paginate(10)
            ->through(fn (Role $role): array => [
                'id' => $role->id,
                'name' => $role->name,
                'permissions_count' => $role->permissions_count,
                'created_at' => $role->created_at->format('M d, Y'),
            ]);

        return Inertia::render('roles/Index', [
            'roles' => $roles,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('roles/Create', [
            'permissions' => Permission::orderBy('name')->pluck('name'),
        ]);
    }

    public function store(StoreRoleRequest $request, CreateRole $action)
    {
        $action->execute(RoleDTO::fromRequest($request));

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
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

    public function update(UpdateRoleRequest $request, Role $role, UpdateRole $action)
    {
        $action->execute($role, RoleDTO::fromRequest($request));

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role, DeleteRole $action)
    {
        try {
            $action->execute($role);

            return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
}
