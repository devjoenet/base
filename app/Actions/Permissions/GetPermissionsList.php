<?php

declare(strict_types=1);

namespace App\Actions\Permissions;

use App\Models\Permission;

class GetPermissionsList
{
    /** @return string[] */
    public function __invoke(): array
    {
        return Permission::select('name')->orderBy('name')->pluck('name')->all();
    }
}
