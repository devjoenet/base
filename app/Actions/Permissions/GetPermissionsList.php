<?php

declare(strict_types=1);

namespace App\Actions\Permissions;

use App\Models\Permission;

class GetPermissionsList
{
    /** @return list<string> */
    public function __invoke(): array
    {
        return Permission::pluck('name')->all();
    }
}
