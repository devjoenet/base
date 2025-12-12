<?php

declare(strict_types=1);

namespace App\Actions\Role;

use App\DataTransferObjects\RoleDTO;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Contracts\Role;

class CreateRole
{
    public function execute(RoleDTO $data): Role
    {
        return DB::transaction(function () use ($data) {
            $role = Role::create(['name' => $data->name]);

            if (! empty($data->permissions)) {
                $role->syncPermissions($data->permissions);
            }

            return $role;
        });
    }
}
