<?php

declare(strict_types=1);

namespace App\Data;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class PermissionData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $guard_name,
        public int $roles_count,

        #[WithCast(DateTimeInterfaceCast::class)]
        public Carbon $created_at,

        #[WithCast(DateTimeInterfaceCast::class)]
        public Carbon $updated_at,
    ) {}
}
