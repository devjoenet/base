<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Teams\CreateTeam;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class TeamController extends Controller
{
    /**
     * Show the form for creating a new team.
     */
    public function create(): Response
    {
        Gate::authorize('create', Team::class);

        return Inertia::render('teams/Create');
    }

    /**
     * Store a newly created team in storage.
     */
    public function store(Request $request, CreateTeam $creator)
    {
        $creator->create($request->user(), $request->all());

        return redirect()->route('dashboard');
    }
}
