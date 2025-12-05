# Tailwind Plus UI Development Plan

This checklist compares the reference starter kit in `VUESTARTER-REF` with the current Tailwind Plus implementation and highlights what still needs to be ported. Each item calls for creating a Tailwind Plus equivalent in `resources/js` that mirrors the reference behavior (styling can adapt to Tailwind Plus tokens).

Use the `# Tailwind Plus Vue Component Library` section of the `AGENTS.md` file to see the original source code for Tailwind Plus blocks. These will need to be broken down, and they contain several areas with example dummy text that will convert to slots. The components created from this source code should be logically broken down to match those in the `VUESTARTER-REF` directory.

## Components (`resources/js/components`)

- Add structural pieces present in `VUESTARTER-REF/resources/js/components` but absent in our build. Each should be rebuilt with Tailwind Plus primitives and wired for the same props/slots/events as the reference. Remove any placeholder content that is provided in the Tailwind Plus code provided. 

## UI library (`resources/js/components/ui`)

- Create the missing `/resources/js/components/ui` directory and recreate the reference UI primitives found under `VUESTARTER-REF/resources/js/components/ui`. Use Tailwind Plus-ready markup and export them via an index.ts barrel file for ergonomic imports. Remove any placeholder content that is provided in the Tailwind Plus code provided. The content of our components should be the same as the content in reference components.


## Layouts (`resources/js/layouts`)

- Add all layouts and sub-layouts from `VUESTARTER-REF/resources/js/layouts`. Adapt them to Tailwind Plus while preserving slot structure and per-page wrappers expected by the reference pages. Remove any placeholder content that is provided in the Tailwind Plus code provided. The content of our components should be the same as the content in reference components.


## Pages (`resources/js/pages`)

- Recreate pages present in `VUESTARTER-REF/resources/js/pages` 

- `VUESTARTER-REF/resources/js/pages`
  - `Dashboard.vue`
  - `Welcome.vue`
- `VUESTARTER-REF/resources/js/pages/auth`
  - `ConfirmPassword.vue`
  - `ForgotPassword.vue`
  - `Login.vue`
  - `Register.vue`
  - `ResetPassword.vue`
  - `TwoFactorChallenge.vue`
  - `VerifyEmail.vue`

- `VUESTARTER-REF/resources/js/pages/settings`
  - `Appearance.vue`
  - `Password.vue`
  - `Profile.vue`
  - `TwoFactor.vue`
  
- Ensure all pages align with the conventions used in their reference counterpart. Each page should consume the new Tailwind Plus components and layouts to maintain feature parity. Currently, don't fill in any data or content that is not present in the reference.
