<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CurrentTeamController extends Controller
{
    /** Update the authenticated user's current team. */
    public function update(Request $request): RedirectResponse
    {
        $team = Team::findOrFail($request->team_id);

        if (! $request->user()->switchTeam($team)) {
            abort(403);
        }

        return back(303);
    }
}
