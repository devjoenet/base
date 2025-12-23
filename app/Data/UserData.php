<?php

declare(strict_types=1);

namespace App\Data;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class UserData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public Optional|Carbon $email_verified_at,
        public Optional|string $password,
        public Optional|string $two_factor_secret,
        public Optional|Carbon $two_factor_confirmed_at,
        public Optional|string $remember_token,
        public Optional|Carbon $created_at,
        public Optional|Carbon $updated_at,
        public Optional|string $role,
        public Optional|string|null $profile_photo_url = null,
    ) {}
}
