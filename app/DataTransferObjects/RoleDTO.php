<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Illuminate\Foundation\Http\FormRequest;

readonly class RoleDTO
{
    /**
     * @param  array<int, string>  $permissions
     */
    public function __construct(
        public string $name,
        public array $permissions,
    ) {}

    public static function fromRequest(FormRequest $request): self
    {
        $data = $request->validated();

        return new self(
            name: $data['name'],
            permissions: $data['permissions'] ?? [],
        );
    }
}
