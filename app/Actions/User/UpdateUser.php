<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\DataTransferObjects\UserDTO;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UpdateUser
{
    public function execute(User $user, UserDTO $data): User
    {
        return DB::transaction(function () use ($user, $data): User {
            $payload = [
                'name' => $data->name,
                'email' => $data->email,
            ];

            if ($data->password) {
                $payload['password'] = Hash::make($data->password);
            }

            $user->update($payload);

            if ($data->role) {
                $user->syncRoles([$data->role]);
            }

            return $user;
        });
    }
}
