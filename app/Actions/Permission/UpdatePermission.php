<?php

declare(strict_types=1);

namespace App\Actions\Permission;

use App\DataTransferObjects\PermissionDTO;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class UpdatePermission
{
    public function execute(Permission $permission, PermissionDTO $data): Permission
    {
        return DB::transaction(function () use ($permission, $data): Permission {
            $permission->update([
                'name' => $data->name,
                'guard_name' => $data->guardName,
            ]);

            return $permission;
        });
    }
}
