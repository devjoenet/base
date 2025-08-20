<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Theme Preview</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
      .bg-surface {
        background: var(--background);
      }

      .text-surface {
        color: var(--foreground);
      }

      .bg-card {
        background: var(--card);
      }

      .text-card {
        color: var(--card-foreground);
      }

      .bg-popover {
        background: var(--popover);
      }

      .text-popover {
        color: var(--popover-foreground);
      }

      .ring-token {
        --tw-ring-color: var(--ring);
      }

      .bg-primary {
        background: var(--color-primary);
      }

      .text-primary {
        color: var(--color-primary-content);
      }

      .bg-secondary {
        background: var(--color-secondary);
      }

      .text-secondary {
        color: var(--color-secondary-content);
      }

      .bg-accent {
        background: var(--color-accent);
      }

      .text-accent {
        color: var(--color-accent-content);
      }

      .bg-info {
        background: var(--color-info);
      }

      .text-info {
        color: var(--color-info-content);
      }

      .bg-success {
        background: var(--color-success);
      }

      .text-success {
        color: var(--color-success-content);
      }

      .bg-warning {
        background: var(--color-warning);
      }

      .text-warning {
        color: var(--color-warning-content);
      }

      .bg-error {
        background: var(--color-error);
      }

      .text-error {
        color: var(--color-error-content);
      }

      /* Borderless “sections”: softly tinted surface + elevation shadows from tokens */
      :root {
        --shadow-color: color-mix(in oklab, var(--foreground) 12%, transparent);
        --shadow-color-strong: color-mix(in oklab, var(--foreground) 18%, transparent);
        --tint-weak: color-mix(in oklab, var(--foreground) 3.5%, var(--background));
        --tint-strong: color-mix(in oklab, var(--foreground) 6%, var(--background));
      }

      .section {
        background: var(--tint-weak);
        border-radius: .875rem;
        box-shadow:
          0 1px 2px var(--shadow-color),
          0 6px 20px -6px var(--shadow-color);
      }

      .section-strong {
        background: var(--tint-strong);
        border-radius: 1rem;
        box-shadow:
          0 1px 3px var(--shadow-color),
          0 14px 32px -10px var(--shadow-color-strong);
      }

      /* Cards: no borders; use elevation + internal separator via subtle inset shadow */
      .card {
        background: var(--card);
        color: var(--card-foreground);
        border-radius: .875rem;
        box-shadow:
          0 1px 2px var(--shadow-color),
          0 10px 24px -12px var(--shadow-color);
        overflow: clip;
      }

      .card-header {
        padding: .75rem 1rem;
        font-weight: 600;
        font-size: .9rem;
        box-shadow: inset 0 -1px 0 color-mix(in oklab, var(--foreground) 8%, transparent);
      }

      .card-body {
        padding: 1rem;
      }

      /* Buttons */
      .btn {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .625rem 1rem;
        border-radius: .5rem;
        font-size: .875rem;
        font-weight: 600;
        background: transparent;
        color: var(--foreground);
        box-shadow: 0 1px 2px rgb(0 0 0 / .05);
        transition: transform .04s ease, box-shadow .2s ease, opacity .2s ease, background .2s ease;
      }

      .btn:focus-visible {
        outline: 0;
        box-shadow: 0 0 0 2px var(--ring);
      }

      .btn:active {
        transform: translateY(1px);
      }

      .btn-primary {
        background: var(--color-primary);
        color: var(--color-primary-content);
      }

      .btn-secondary {
        background: var(--color-secondary);
        color: var(--color-secondary-content);
      }

      .btn-accent {
        background: var(--color-accent);
        color: var(--color-accent-content);
      }

      .btn-ghost {
        background: transparent;
        color: var(--foreground);
      }

      .btn-outline {
        background: var(--tint-weak);
        color: var(--foreground);
        box-shadow: inset 0 0 0 1px color-mix(in oklab, var(--foreground) 10%, transparent);
      }

      /* Inputs */
      .input {
        width: 100%;
        background: var(--background);
        color: var(--foreground);
        padding: .5rem .75rem;
        border-radius: .5rem;
        box-shadow:
          inset 0 0 0 1px color-mix(in oklab, var(--foreground) 12%, transparent),
          0 1px 2px rgb(0 0 0 / .05);
      }

      .input:focus-visible {
        outline: 0;
        box-shadow: 0 0 0 2px var(--ring);
      }

      /* Swatches */
      .swatch {
        border-radius: .5rem;
        height: 2.25rem;
        box-shadow: inset 0 0 0 1px color-mix(in oklab, var(--foreground) 8%, transparent);
      }

      /* Sidebar (borderless) */
      .sidebar {
        background: var(--tint-strong);
        color: var(--foreground);
        border-radius: 1rem;
        box-shadow:
          0 1px 3px var(--shadow-color),
          0 14px 32px -10px var(--shadow-color-strong);
        padding: 1rem;
      }
    </style>
  </head>
  <body class="bg-surface text-surface antialiased">
    <header class="bg-popover/80 text-popover sticky top-0 z-10 backdrop-blur">
      <div class="section mx-auto flex max-w-7xl items-center justify-between px-4 py-3">
        <div class="flex items-center gap-3">
          <div class="bg-primary size-8 rounded-lg"></div>
          <div>
            <h1 class="text-sm font-semibold">Theme Preview</h1>
            <p class="text-xs opacity-70">Teal primary · Indigo secondary · Fuchsia accent · Navy bases</p>
          </div>
        </div>
        <div class="flex items-center gap-2">
          <button id="toggleDark" class="btn btn-outline"><span id="modeLabel">System</span> mode</button>
          <a href="{{ route('dev.theme-preview') }}" class="btn btn-ghost">Reload</a>
        </div>
      </div>
    </header>

    <main class="mx-auto grid max-w-7xl grid-cols-1 gap-6 px-4 py-8 lg:grid-cols-[280px_minmax(0,1fr)]">
      <aside class="sidebar">
        <h2 class="mb-3 text-sm font-semibold">Sidebar</h2>
        <nav class="space-y-1">
          <a class="hover:bg-accent/10 block rounded-md px-3 py-2" href="#">Dashboard</a>
          <a class="hover:bg-accent/10 block rounded-md px-3 py-2" href="#">Projects</a>
          <a class="hover:bg-accent/10 block rounded-md px-3 py-2" href="#">Billing</a>
          <a class="hover:bg-accent/10 block rounded-md px-3 py-2" href="#">Settings</a>
        </nav>
        <div class="mt-4">
          <button class="btn btn-primary w-full">Primary</button>
        </div>
      </aside>

      <section class="space-y-6">
        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
          <div class="card">
            <div class="card-header">Buttons</div>
            <div class="card-body space-y-3">
              <div class="flex flex-wrap gap-2">
                <button class="btn btn-primary">Primary</button>
                <button class="btn btn-secondary">Secondary</button>
                <button class="btn btn-accent">Accent</button>
                <button class="btn btn-outline">Outline</button>
                <button class="btn btn-ghost">Ghost</button>
                <button class="btn btn-primary" disabled>Disabled</button>
              </div>
              <p class="text-xs opacity-70">Focus ring uses <code>--ring</code></p>
            </div>
          </div>

          <div class="card">
            <div class="card-header">Inputs</div>
            <div class="card-body space-y-3">
              <input class="input" placeholder="Input with token ring" />
              <select class="input">
                <option>Option A</option>
                <option>Option B</option>
              </select>
              <div class="flex gap-2 text-xs opacity-70">
                <span>Borderless look via inset shadow</span>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header">Feedback</div>
            <div class="card-body space-y-2">
              <div class="bg-info text-info rounded-md px-3 py-2">Info</div>
              <div class="bg-success text-success rounded-md px-3 py-2">Success</div>
              <div class="bg-warning text-warning rounded-md px-3 py-2">Warning</div>
              <div class="bg-error text-error rounded-md px-3 py-2">Error</div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header">Surfaces</div>
          <div class="card-body grid grid-cols-1 gap-4 sm:grid-cols-3">
            <div>
              <div class="swatch" style="background: var(--color-base-100)"></div>
              <p class="mt-2 text-xs opacity-70">base-100 (bg)</p>
            </div>
            <div>
              <div class="swatch" style="background: var(--color-base-200)"></div>
              <p class="mt-2 text-xs opacity-70">base-200 (surface)</p>
            </div>
            <div>
              <div class="swatch" style="background: var(--color-base-300)"></div>
              <p class="mt-2 text-xs opacity-70">base-300 (elevated)</p>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header">Chart Bars</div>
          <div class="card-body space-y-3">
            <div class="flex items-center gap-3">
              <span class="w-24 text-xs opacity-70">Series 1</span>
              <div class="h-3 rounded-md" style="background: var(--chart-1); width: 62%"></div>
            </div>
            <div class="flex items-center gap-3">
              <span class="w-24 text-xs opacity-70">Series 2</span>
              <div class="h-3 rounded-md" style="background: var(--chart-2); width: 48%"></div>
            </div>
            <div class="flex items-center gap-3">
              <span class="w-24 text-xs opacity-70">Series 3</span>
              <div class="h-3 rounded-md" style="background: var(--chart-3); width: 76%"></div>
            </div>
            <div class="flex items-center gap-3">
              <span class="w-24 text-xs opacity-70">Series 4</span>
              <div class="h-3 rounded-md" style="background: var(--chart-4); width: 34%"></div>
            </div>
            <div class="flex items-center gap-3">
              <span class="w-24 text-xs opacity-70">Series 5</span>
              <div class="h-3 rounded-md" style="background: var(--chart-5); width: 58%"></div>
            </div>
          </div>
        </div>

        <div class="section-strong p-4">
          <h4 class="mb-1 text-sm font-semibold">Borderless Section</h4>
          <p class="text-sm opacity-80">This block shows area without borders using a tinted surface and elevation shadows.</p>
        </div>
      </section>
    </main>

    <script>
      // Robust theme manager: 'light' | 'dark' | 'system'
      (function() {
        const storageKey = 'theme';
        const mql = window.matchMedia('(prefers-color-scheme: dark)');
        const html = document.documentElement;
        const label = () => document.getElementById('modeLabel');

        function applyTheme(mode) {
          const isDark = mode === 'dark' || (mode === 'system' && mql.matches);
          html.classList.toggle('dark', isDark);
          const l = label();
          if (l) l.textContent = mode.charAt(0).toUpperCase() + mode.slice(1);
        }

        function getMode() {
          try {
            return localStorage.getItem(storageKey) || 'system';
          } catch {
            return 'system';
          }
        }

        function setMode(mode) {
          try {
            localStorage.setItem(storageKey, mode);
          } catch {}
          applyTheme(mode);
        }

        // Init & keep in sync with OS when in 'system'
        applyTheme(getMode());
        mql.addEventListener?.('change', () => {
          if (getMode() === 'system') applyTheme('system');
        });

        // Click cycles: light → dark → system
        document.getElementById('toggleDark')?.addEventListener('click', () => {
          const order = ['light', 'dark', 'system'];
          const current = getMode();
          const next = order[(order.indexOf(current) + 1) % order.length];
          setMode(next);
        });
      })();
    </script>
  </body>
</html>
