# Project Guidelines

## Overview
This repository is a Laravel 12 application with an Inertia.js + Vue 3 + TypeScript frontend, built with Vite and Tailwind CSS.

- Backend: Laravel 12 (PHP 8.4), Fortify for auth, Spatie Data and Permission packages.
- Frontend: Vue 3 (TypeScript), Inertia.js, Vite, Tailwind CSS.
- Tooling: Pest for tests, Laravel Pint for PHP style, ESLint + Prettier for JS/TS/Vue, Rector and PHPStan/Larastan for static analysis, Vite for builds.

## Project structure (high level)
- app/ — Laravel application code (HTTP controllers, Actions, Data objects, etc.)
- resources/js — Frontend (Vue components, pages, types)
- routes/ — Route definitions
- tests/ — Pest tests
- public/ — Public web root
- config/, database/, storage/ — Standard Laravel directories
- vite.config.ts, eslint.config.ts, pint.json, phpstan.neon, rector.php — Tooling configs

## How Junie should validate changes
When changes affect code behavior, run tests and basic linters/build locally before submitting.

### PHP tests
- Preferred: `composer test`
  - This runs `php artisan test` with configuration clear step.

### Frontend build (when touching resources/js or Vite config)
- Build: `npm run build`
- Dev (optional, for local checks): `npm run dev`

### Linters/formatters (recommended when touching respective code)
- PHP/JS/TS/Vue: `composer format` (runs Rector, Pint and `npm run format`; safe to run locally)

## Code style
- PHP: Follow Laravel conventions; use Pint default rules. Avoid adding unrelated style changes.
- JS/TS/Vue: Follow ESLint + Prettier setup. Keep TypeScript types accurate; prefer composition API.
- Commit minimal diffs focused on the issue.

## Running the app locally (optional)
- The backend is always running locally with all services on Laravel Herd.
- `npm run dev` needs to be run to serve the frontend if it is not already running.

## Notes
- Type generation: The project uses Spatie TypeScript Transformer; if backend types change, ensure generated types are up to date (check `resources/js/types/generated.d.ts`).
- Permissions/auth: Spatie Permission and Laravel Fortify are present; align new features with roles/permissions where relevant.
