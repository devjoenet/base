<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ])->each(function ($user): void {
            $team = Team::forceCreate([
                'user_id' => $user->id,
                'name' => explode(' ', (string) $user->name, 2)[0]."'s Team",
                'personal_team' => true,
            ]);

            $user->switchTeam($team);
        });
    }
}
