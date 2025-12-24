<?php

declare(strict_types=1);

namespace App\Data;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\Permission\Models\Permission;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class PermissionData extends Data
{
    public function __construct(
        public int|Optional $id,
        #[Min(3)]
        public string $name,
        public string|Optional $guard_name,
        public int|Optional $roles_count,
        public Carbon|string|Optional $created_at,
        public Carbon|string|Optional $updated_at,
    ) {}

    public static function fromModel(Permission $permission): self
    {
        return new self(
            id: $permission->id,
            name: $permission->name,
            guard_name: $permission->guard_name,
            roles_count: $permission->roles_count ?? $permission->roles()->count(),
            created_at: $permission->created_at?->format('M d, Y') ?? Optional::create(),
            updated_at: $permission->updated_at?->format('M d, Y') ?? Optional::create(),
        );
    }
}
