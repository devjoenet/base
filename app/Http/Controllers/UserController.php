<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Users\StoreUserAction;
use App\Actions\Users\UpdateUserAction;
use App\Data\UserData;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('users/Index', [
            'users' => UserData::collect(
                User::with('roles')->latest()->paginate(10)
            ),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('users/Create', [
            'user' => UserData::empty(),
            'roles' => Role::pluck('name')->toArray(),
        ]);
    }

    public function store(UserData $data, StoreUserAction $action): RedirectResponse
    {
        $action->execute($data);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user): Response
    {
        return Inertia::render('users/Edit', [
            'user' => UserData::from($user),
            'roles' => Role::pluck('name')->toArray(),
        ]);
    }

    public function update(User $user, UserData $data, UpdateUserAction $action): RedirectResponse
    {
        $action->execute($user, $data);

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->is(auth()->user())) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
