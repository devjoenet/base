<?php

declare(strict_types=1);

namespace App\Actions\Teams;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class CreateTeam
{
    /**
     * Validate and create a new team for the given user.
     *
     * @param  array<string, string>  $input
     */
    public function create(User $user, array $input): Team
    {
        Gate::forUser($user)->authorize('create', Team::class);

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
        ])->validateWithBag('createTeam');

        return DB::transaction(function () use ($user, $input) {
            $team = Team::forceCreate([
                'user_id' => $user->id,
                'name' => $input['name'],
                'personal_team' => false,
            ]);

            $user->ownedTeams()->save($team);
            $user->switchTeam($team);

            return $team;
        });
    }
}
