# Tailwind Plus UI Development Plan

Please review `GEMINI.md`, especially the sections titled `# Tailwind Plus UI Development Plan` and `# Tailwind Plus Vue Component Library`. These sections outline the tasks we need to create, the Tailwind Plus source code, and the location of the code we're referencing to achieve functional parity with the reference code.

We're using Tailwind Plus to create primitives (`./resources/js/components/ui`) components (`./resources/js/components`) , layouts (`./resources/js/layouts/*`) , and pages (`./resources/js/pages/*`) that are functionally equivalent to the reference code (see ./.VUESTARTER-REF/*).

Please review this plan and start writing down tasks that we can follow to complete everything in the plan. Avoid modifying any files across multiple tasks.

- Review an example Vue file from the `./.VUESTARTER-REF` directory to understand its functionality and structure.
- Locate a snippet of code from the Tailwind Plus code in the `GEMINI.md` that matches the structure (roughly).
- Select only the necessary code and remove any placeholder content.
- Using the appropriate amount of code from the Tailwind Plus code you selected, write it to the new file (excluding any example content) and supplement it with any TypeScript, HeadlessUI component, or VueUse code you need to ensure it's functionally equivalent to the reference component. This means that the new component should use the Tailwind CSS class names provided in the Tailwind Plus code, not those in the reference code. Additionally, our new component should not rely on anything from `reka-ui` or `lucide-vue-next`. Those should be rewritten to achieve the same functionality using any available resources in the project's root `./package.json`.
- Any input, checkbox, radio and button should be styled to Material Design 3 specs (or as close as possible) using only libraries already present in `./package.json` and tailwindcss classes.

## Components (`resources/js/components`)

- Add structural pieces present in `.VUESTARTER-REF/resources/js/components` but absent in our build. Each should be rebuilt with Tailwind Plus primitives and wired for the same props/slots/events as the reference. Remove any placeholder content that is provided in the Tailwind Plus code provided. 

## UI library (`resources/js/components/ui`)

- Create the missing `/resources/js/components/ui` directory and recreate the reference UI primitives found under `.VUESTARTER-REF/resources/js/components/ui`. Use Tailwind Plus-ready markup and export them via an index.ts barrel file for ergonomic imports. Remove any placeholder content that is provided in the Tailwind Plus code provided. The content of our components should be the same as the content in reference components.


## Layouts (`resources/js/layouts`)

- Add all layouts and sub-layouts from `.VUESTARTER-REF/resources/js/layouts`. Adapt them to Tailwind Plus while preserving slot structure and per-page wrappers expected by the reference pages. Remove any placeholder content that is provided in the Tailwind Plus code provided. The content of our components should be the same as the content in reference components.


## Pages (`resources/js/pages`)

- Recreate pages present in `.VUESTARTER-REF/resources/js/pages` 

- `.VUESTARTER-REF/resources/js/pages`
  - `Dashboard.vue`
  - `Welcome.vue`
- `.VUESTARTER-REF/resources/js/pages/auth`
  - `ConfirmPassword.vue`
  - `ForgotPassword.vue`
  - `Login.vue`
  - `Register.vue`
  - `ResetPassword.vue`
  - `TwoFactorChallenge.vue`
  - `VerifyEmail.vue`

- `.VUESTARTER-REF/resources/js/pages/settings`
  - `Appearance.vue`
  - `Password.vue`
  - `Profile.vue`
  - `TwoFactor.vue`
  
- Ensure all pages align with the conventions used in their reference counterpart. Each page should consume the new Tailwind Plus components and layouts to maintain feature parity. Currently, don't fill in any data or content that is not present in the reference.
