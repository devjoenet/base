<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Permission\CreatePermission;
use App\Actions\Permission\DeletePermission;
use App\Actions\Permission\UpdatePermission;
use App\DataTransferObjects\PermissionDTO;
use App\Http\Requests\Permission\StorePermissionRequest;
use App\Http\Requests\Permission\UpdatePermissionRequest;
use Exception;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(): Response
    {
        $permissions = Permission::withCount('roles')
            ->orderBy('name')
            ->paginate(10)
            ->through(fn (Permission $permission): array => [
                'id' => $permission->id,
                'name' => $permission->name,
                'guard_name' => $permission->guard_name,
                'roles_count' => $permission->roles_count,
                'created_at' => $permission->created_at->format('M d, Y'),
            ]);

        return Inertia::render('permissions/Index', [
            'permissions' => $permissions,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('permissions/Create', [
            'default_guard' => config('auth.defaults.guard'),
        ]);
    }

    public function store(StorePermissionRequest $request, CreatePermission $action)
    {
        $action->execute(PermissionDTO::fromRequest($request));

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }

    public function edit(Permission $permission): Response
    {
        return Inertia::render('permissions/Edit', [
            'permission' => [
                'id' => $permission->id,
                'name' => $permission->name,
                'guard_name' => $permission->guard_name,
            ],
            'default_guard' => config('auth.defaults.guard'),
        ]);
    }

    public function update(UpdatePermissionRequest $request, Permission $permission, UpdatePermission $action)
    {
        $action->execute($permission, PermissionDTO::fromRequest($request));

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission, DeletePermission $action)
    {
        try {
            $action->execute($permission);

            return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
}
