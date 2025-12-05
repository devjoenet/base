# Tailwind Plus parity backlog

This checklist compares the reference starter kit in `VUESTARTER-REF` with the current Tailwind Plus implementation and highlights what still needs to be ported. Each item calls for creating a Tailwind Plus equivalent in `resources/js` that mirrors the reference behavior (styling can adapt to Tailwind Plus tokens).

## Components (`resources/js/components`)
- Add structural pieces present in `VUESTARTER-REF/resources/js/components` but absent in our build: `AlertError.vue`, `AppContent.vue`, `AppHeader.vue`, `AppLogo.vue`, `AppLogoIcon.vue`, `AppShell.vue`, `AppSidebar.vue`, `AppSidebarHeader.vue`, `AppearanceTabs.vue`, `Breadcrumbs.vue`, `DeleteUser.vue`, `Heading.vue`, `HeadingSmall.vue`, `Icon.vue`, `InputError.vue`, `NavFooter.vue`, `NavMain.vue`, `NavUser.vue`, `PlaceholderPattern.vue`, `TextLink.vue`, `TwoFactorRecoveryCodes.vue`, `TwoFactorSetupModal.vue`, `UserInfo.vue`, and `UserMenuContent.vue`. Each should be rebuilt with Tailwind Plus primitives and wired for the same props/slots/events as the reference.

## UI library (`resources/js/components/ui`)
- Create the missing `components/ui` namespace and recreate the reference UI primitives found under `VUESTARTER-REF/resources/js/components/ui`: alert, avatar, badge, breadcrumb, button, card, checkbox, collapsible, dialog, dropdown-menu, input, label, navigation-menu, pin-input, separator, sheet, sidebar, skeleton, spinner, and tooltip. Use Tailwind Plus-ready markup and export them via an index for ergonomic imports.

## Layouts (`resources/js/layouts`)
- Add the sub-layouts from `VUESTARTER-REF/resources/js/layouts`: `app/AppHeaderLayout.vue`, `app/AppSidebarLayout.vue`, `auth/AuthCardLayout.vue`, `auth/AuthSimpleLayout.vue`, `auth/AuthSplitLayout.vue`, and `settings/Layout.vue`. Adapt them to Tailwind Plus while preserving slot structure and per-page wrappers expected by the reference pages.

## Pages (`resources/js/pages`)
- Recreate the settings pages present in `VUESTARTER-REF/resources/js/pages/settings`—`Appearance.vue`, `Password.vue`, and `TwoFactor.vue`—and ensure `Profile.vue` aligns with the settings layout conventions used in the reference. Each page should consume the new Tailwind Plus components and layouts to maintain feature parity.
