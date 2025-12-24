<?php

declare(strict_types=1);

namespace App\Actions\Users;

use App\Data\UserData;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Optional;

class UpdateUserAction
{
    public function execute(User $user, UserData $data): User
    {
        $payload = [
            'name' => $data->name,
            'email' => $data->email,
        ];

        if (! $data->password instanceof Optional) {
            $payload['password'] = Hash::make($data->password);
        }

        $user->update($payload);

        if (! $data->role instanceof Optional) {
            $user->syncRoles([$data->role]);
        }

        return $user;
    }
}
