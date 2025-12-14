<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\PermissionData;
use Exception;
use Illuminate\Http\RedirectResponse;
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

    public function store(PermissionData $data): RedirectResponse
    {
        if (new Permission($data->toArray())->save()) {
            return to_route('permissions.index')->with('success', 'Permission created successfully.');
        }

        return back()->with('error', 'Failed to create permission.');
    }

    public function edit(Permission $permission): Response
    {
        return Inertia::render('permissions/Edit', [
            'permission' => PermissionData::from($permission),
            'default_guard' => config('auth.defaults.guard'),
        ]);
    }

    public function update(Permission $permission, PermissionData $data): RedirectResponse
    {
        $permission->update($data->all());

        return redirect()
            ->route('permissions.index')
            ->with('success', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        try {
            $permission->delete();

            return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
}
