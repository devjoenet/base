<?php

declare(strict_types=1);

namespace App\Actions\Role;

use App\DataTransferObjects\RoleDTO;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UpdateRole
{
    public function execute(Role $role, RoleDTO $data): Role
    {
        return DB::transaction(function () use ($role, $data): Role {
            $role->update(['name' => $data->name]);

            $role->syncPermissions($data->permissions);

            return $role;
        });
    }
}
