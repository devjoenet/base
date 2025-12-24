<?php

declare(strict_types=1);

namespace App\Data;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class UserData extends Data
{
    public function __construct(
        public int|Optional $id,
        public string $name,
        #[Email]
        public string $email,
        public Optional|Carbon $email_verified_at,
        #[Min(8)]
        public Optional|string $password,
        public Optional|string $two_factor_secret,
        public Optional|Carbon $two_factor_confirmed_at,
        public Optional|string $remember_token,
        public Optional|Carbon|string $created_at,
        public Optional|Carbon|string $updated_at,
        public Optional|string $role,
        public Optional|string|null $profile_photo_url = null,
    ) {}

    public static function rules(ValidationContext $context): array
    {
        $userId = $context->payload['id'] ?? null;

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($userId),
            ],
            'password' => [
                $userId ? 'nullable' : 'required',
                'string',
                'min:8',
            ],
            'role' => ['nullable', 'string', 'exists:roles,name'],
        ];
    }

    public static function fromModel(User $user): self
    {
        return new self(
            id: $user->id,
            name: $user->name,
            email: $user->email,
            email_verified_at: $user->email_verified_at,
            password: Optional::create(),
            two_factor_secret: $user->two_factor_secret ?? Optional::create(),
            two_factor_confirmed_at: $user->two_factor_confirmed_at ?? Optional::create(),
            remember_token: $user->remember_token ?? Optional::create(),
            created_at: $user->created_at?->format('M d, Y') ?? Optional::create(),
            updated_at: $user->updated_at?->format('M d, Y') ?? Optional::create(),
            role: $user->getRoleNames()->first() ?? Optional::create(),
            profile_photo_url: $user->profile_photo_url,
        );
    }
}
