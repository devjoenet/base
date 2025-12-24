<?php

declare(strict_types=1);

namespace App\Data;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\Validation\ArrayType;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\Permission\Models\Role;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class RoleData extends Data
{
    public function __construct(
        public int|Optional $id,
        #[Min(3)]
        public string $name,

        /** @var list<string> */
        #[ArrayType]
        public array $permissions,

        public int|Optional $permissions_count,
        public Carbon|string|Optional $created_at,
    ) {}

    public static function fromModel(Role $role): self
    {
        return new self(
            id: $role->id,
            name: $role->name,
            permissions: $role->permissions->pluck('name')->toArray(),
            permissions_count: $role->permissions_count ?? $role->permissions()->count(),
            created_at: $role->created_at?->format('M d, Y') ?? Optional::create(),
        );
    }
}
