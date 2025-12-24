<?php

declare(strict_types=1);

namespace App\Actions\Users;

use App\Data\UserData;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Optional;

class StoreUserAction
{
    public function execute(UserData $data): User
    {
        /** @var User $user */
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password),
        ]);

        if ($data->role instanceof Optional === false) {
            $user->assignRole($data->role);
        }

        return $user;
    }
}
