<?php

declare(strict_types=1);

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class PermissionData extends Data
{
    public function __construct(
        public string $name,
        public string $guardName = 'web',
    ) {}
}
