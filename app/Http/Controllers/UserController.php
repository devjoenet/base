<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\UserData;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('users/Index', [
            'users' => User::with('roles')
                ->latest()
                ->paginate(10)
                ->through(fn (User $user): array => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->getRoleNames()->first() ?? 'user',
                    'created_at' => $user->created_at->format('M d, Y'),
                    'profile_photo_url' => $user->profile_photo_url,
                ]),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('users/Create', [
            'user' => UserData::empty(),
            'roles' => Role::pluck('name')->toArray(),
        ]);
    }

    public function store(UserData $data): RedirectResponse
    {
        /** @var User $user */
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password),
        ]);

        if ($data->role) {
            $user->assignRole($data->role);
        }

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user): Response
    {
        return Inertia::render('users/Edit', [
            'user' => UserData::from($user),
            'roles' => Role::pluck('name')->toArray(),
        ]);
    }

    public function update(User $user, UserData $data): RedirectResponse
    {
        $payload = $data->only('name', 'email')->toArray();

        if ($data->password) {
            $payload['password'] = Hash::make($data->password);
        }

        $user->update($payload);

        if ($data->role) {
            $user->syncRoles([$data->role]);
        }

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
