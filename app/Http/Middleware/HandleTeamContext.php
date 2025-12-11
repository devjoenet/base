<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleTeamContext
{
    /** @param  Closure(Request): (Response)  $next */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->current_team_id) {
            // Set the Spatie Permission team_id global context
            // This ensures all permission checks ($user->can('edit'))
            // are scoped to the current team.
            setPermissionsTeamId($request->user()->current_team_id);
        }

        return $next($request);
    }
}
