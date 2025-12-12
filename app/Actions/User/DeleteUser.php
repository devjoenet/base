<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class DeleteUser
{
    public function execute(User $user): void
    {
        DB::transaction(function () use ($user): void {
            // Detach roles before deleting if strict foreign keys exist (usually handled by cascade, but safe practice)
            $user->roles()->detach();

            $user->delete();
        });
    }
}
