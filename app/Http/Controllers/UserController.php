<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\User\CreateUser;
use App\Actions\User\DeleteUser;
use App\Actions\User\UpdateUser;
use App\DataTransferObjects\UserDTO;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(): Response
    {
        $users = User::with('roles')
            ->latest()
            ->paginate(10)
            ->through(fn (User $user): array => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->getRoleNames()->first() ?? 'user',
                'created_at' => $user->created_at->format('M d, Y'),
                'profile_photo_url' => $user->profile_photo_url,
            ]);

        return Inertia::render('users/Index', [
            'users' => $users,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('users/Create', [
            'roles' => Role::pluck('name'),
        ]);
    }

    public function store(StoreUserRequest $request, CreateUser $action)
    {
        $action->execute(UserDTO::fromRequest($request));

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user): Response
    {
        return Inertia::render('users/Edit', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->getRoleNames()->first() ?? '',
                'profile_photo_url' => $user->profile_photo_url,
            ],
            'roles' => Role::pluck('name'),
        ]);
    }

    public function update(UpdateUserRequest $request, User $user, UpdateUser $action)
    {
        $action->execute($user, UserDTO::fromRequest($request));

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user, DeleteUser $action)
    {
        if ($user->is(auth()->user())) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $action->execute($user);

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
