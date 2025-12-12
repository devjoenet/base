<?php

declare(strict_types=1);

namespace App\Actions\Permission;

use Spatie\Permission\Models\Permission;

class DeletePermission
{
    public function execute(Permission $permission): void
    {
        $permission->delete();
    }
}
