<?php

declare(strict_types=1);

namespace App\Actions\Permission;

use App\DataTransferObjects\PermissionDTO;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class CreatePermission
{
    public function execute(PermissionDTO $data): Permission
    {
        return DB::transaction(function () use ($data): Permission {
            return Permission::create([
                'name' => $data->name,
                'guard_name' => $data->guardName,
            ]);
        });
    }
}
