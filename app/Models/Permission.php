<?php

declare(strict_types=1);

namespace App\Models;

use App\Data\PermissionData;
use Spatie\LaravelData\WithData;
use Spatie\Permission\Models\Permission as BasePermission;

class Permission extends BasePermission
{
    use WithData;

    protected string $dataClass = PermissionData::class;
}
