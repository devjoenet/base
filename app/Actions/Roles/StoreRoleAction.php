<?php

declare(strict_types=1);

namespace App\Actions\Roles;

use App\Data\RoleData;
use Spatie\Permission\Models\Role;

class StoreRoleAction
{
    public function execute(RoleData $data): Role
    {
        $role = Role::create(['name' => $data->name]);

        if ($data->permissions !== []) {
            $role->syncPermissions($data->permissions);
        }

        return $role;
    }
}
