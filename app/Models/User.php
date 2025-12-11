<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory;
    use HasRoles;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /** @var list<string> */
    protected $fillable = [
        'name',
        'email',
        'password',
        'current_team_id',
    ];

    /** @var list<string> */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /** Get the current team of the user. */
    public function currentTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'current_team_id');
    }

    /** Get all of the teams the user owns. */
    public function ownedTeams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    /** Get all of the teams the user belongs to. */
    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_user', 'user_id', 'team_id')
            ->withPivot('role')
            ->withTimestamps();
    }

    /** Get all of the teams the user owns or belongs to. */
    public function allTeams()
    {
        return $this->ownedTeams->merge($this->teams)->sortBy('name');
    }

    /** Determine if the user owns the given team. */
    public function ownsTeam(?Team $team): bool
    {
        if (is_null($team)) {
            return false;
        }

        return $this->id === $team->user_id;
    }

    /** Switch the user's context to the given team. */
    public function switchTeam(Team $team): bool
    {
        if (! $this->belongsToTeam($team)) {
            return false;
        }

        $this->forceFill([
            'current_team_id' => $team->id,
        ])->save();

        $this->setRelation('currentTeam', $team);

        return true;
    }

    /** Determine if the user belongs to the given team. */
    public function belongsToTeam(?Team $team): bool
    {
        if (is_null($team)) {
            return false;
        }
        if ($this->ownsTeam($team)) {
            return true;
        }

        return (bool) $this->teams->contains($team);
    }
}
