<?php

declare(strict_types=1);

namespace App\Actions\Roles;

use App\Data\RoleData;
use Spatie\Permission\Models\Role;

class UpdateRoleAction
{
    public function execute(Role $role, RoleData $data): Role
    {
        $role->update(['name' => $data->name]);

        $role->syncPermissions($data->permissions);

        return $role;
    }
}
