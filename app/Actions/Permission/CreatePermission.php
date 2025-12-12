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
        return DB::transaction(fn (): Permission => Permission::create([
            'name' => $data->name,
            'guard_name' => $data->guardName,
        ]));
    }
}
