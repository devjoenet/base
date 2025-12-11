<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->index()->comment('The owner of the team');
            $table->string('name');
            $table->boolean('personal_team');
            $table->timestamps();
        });

        Schema::create('team_user', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('team_id');
            $table->foreignId('user_id');
            $table->string('role')->nullable();
            $table->timestamps();

            $table->unique(['team_id', 'user_id']);
        });

        Schema::table('users', function (Blueprint $table): void {
            $table->foreignId('current_team_id')->nullable()->after('password');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn('current_team_id');
        });

        Schema::dropIfExists('team_user');
        Schema::dropIfExists('teams');
    }
};
