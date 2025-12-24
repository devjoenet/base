# Project Guidelines

## Overview
This repository is a Laravel 12 application with an Inertia.js 2 + Vue 3 + TypeScript frontend, built with Vite and Tailwind CSS 4.

- Backend: Laravel 12 (PHP 8.4/8.5), MySQL, Fortify for auth, Spatie Data and Permission packages.
- Frontend: Vue 3 (Composition API, TypeScript), Inertia.js 2, Vite, Tailwind CSS 4, DaisyUI 5.
- Component Stack: Reka-UI, Lucide-Vue, VueUse/core, Class Variance Authority (CVA), CLSX, Tailwind Merge, TW Animate CSS, Vue Input OTP.
- Tooling: Pest for tests, Laravel Pint for PHP style, ESLint + Prettier for JS/TS/Vue, Rector and PHPStan/Larastan for static analysis.

## Build & Configuration Instructions

### Initial Setup
1. **PHP Dependencies**: Install using Composer.
   ```bash
   composer install
   ```
2. **Environment**: Copy `.env.example` to `.env` and generate the app key.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
3. **Database**: The project is configured for SQLite by default (for development). Ensure `database/database.sqlite` exists and run migrations.
   ```bash
   touch database/database.sqlite
   php artisan migrate
   ```
4. **JS Dependencies**: Install using Bun (preferred) or npm.
   ```bash
   bun install
   ```
5. **Build Assets**:
   ```bash
   bun run build
   ```
6. **IDE Helpers**: Generate IDE helpers and models.
   ```bash
   composer ide
   ```

### Development Server
To run all services (Server, Queue, Vite, etc.) concurrently:
```bash
composer dev
```

## Architecture & Coding Methodology

### Backend (Laravel)
- **General Principles**: Follow SOLID principles. Keep controllers thin and models heavy. Use dependency injection extensively.
- **Actions**: Implement complex operations using single action classes (e.g., `UpdateUserProfile.php`).
- **Data Handling**: Use Spatie Laravel Data for Data Transfer Objects (DTOs). Use dedicated request and response classes.
- **Coding Style**: Use modern PHP features like short-nullable syntax. Practice early returns to reduce nesting.
- **Roles & Permissions**: Use [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission/v6/introduction). When adding roles/permissions features, start with the Spatie package integration.

### Frontend (Vue 3 / Inertia.js 2)
- **Composition API**: Prioritize the Composition API with TypeScript and robust type definitions.
- **Inertia.js 2**: Follow Inertia 2 principles for page transitions and data sharing.
- **Forms**: Use the Inertia `<Form>` component and leverage Laravel Wayfinder for routing.
- **Components**: Keep Vue components focused, composable, and light in responsibility. Extract reusable code to central locations.
- **Icons**: Sourced and implemented using `Lucide-Vue`.

### UI/UX (Tailwind CSS 4 & DaisyUI 5)
- **Aesthetic**: Minimal and clean, mimicking Material Design 3 (floating labels, ripple animations on buttons, soft shadows, controlled rounded corners).
- **Styling**:
    - Use DaisyUI 5 component classes as the primary method.
    - Use Tailwind CSS 4 utility classes for customization. Use `!` as a last resort for specificity issues (e.g., `btn bg-red-500!`).
    - Use OKLCH color values for custom colors.
    - Use CVA, CLSX, and Tailwind Merge for managing component variants and utility classes.
- **Animations**: Implement complex interactions using TW Animate CSS and VueUse/core. Avoid additional NPM libraries for these purposes.

## Testing Information

The project uses **Pest** for testing.

### Running Tests
To run the full test suite while ensuring the configuration cache is cleared:
```bash
composer test
```

### Adding New Tests
- **Feature Tests**: Place in `tests/Feature`. Use the `test()` or `it()` functions.
- **Unit Tests**: Place in `tests/Unit`.
- **Setup**: Global test configuration and expectations are in `tests/Pest.php`.

### Example Test
Create a file `tests/Feature/ExampleNewTest.php`:
```php
<?php

test('it can access the home page', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
```

## Additional Development Information

### Code Style & Formatting
- **PHP**: Follows Laravel conventions with additional strict rules (strict types, strict comparison).
  - Run all formatters (Rector, Pint, Prettier): `composer format`
  - Rector is used for automated refactoring and code quality (`rector.php`).
  - Pint is used for code style (`pint.json`).
- **Frontend**: Uses Prettier and ESLint.
  - Run Prettier: `bun run format`
  - Run ESLint: `bun run lint`

### Static Analysis
- **PHPStan/Larastan**: Level 5 is configured in `phpstan.neon`.
  ```bash
  ./vendor/bin/phpstan analyse
  ```

### TypeScript Type Generation
The project uses `spatie/laravel-typescript-transformer`. To update generated TypeScript types from PHP Data objects:
```bash
php artisan typescript:transform
```
Generated types are located in `resources/js/types/generated.d.ts`.

### Project Structure (high level)
- `app/` — Laravel application code (HTTP controllers, Actions, Data objects, etc.)
- `resources/js/` — Frontend (Vue components, pages, types)
- `routes/` — Route definitions
- `tests/` — Pest tests
- `public/` — Public web root
- `config/`, `database/`, `storage/` — Standard Laravel directories
- `vite.config.ts`, `eslint.config.ts`, `pint.json`, `phpstan.neon`, `rector.php` — Tooling configs
