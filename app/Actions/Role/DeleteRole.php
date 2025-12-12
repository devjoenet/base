<?php

declare(strict_types=1);

namespace App\Actions\Role;

use Exception;
use Spatie\Permission\Models\Role;

class DeleteRole
{
    public function execute(Role $role): void
    {
        // Optional: specific business logic preventing deletion of 'admin' or 'user' roles
        if (in_array($role->name, ['admin', 'user', 'super-admin'])) {
            throw new Exception('Cannot delete system roles.');
        }

        $role->delete();
    }
}
