# Current project status

Last updated: 2026-09-14

## Active stage

Legal hardening of the public Cropkeeper site before production payment-provider onboarding.

The canonical legal-document architecture, final substantive Offer / Personal Data Processing Policy revision, and consent-gated Yandex Metrika runtime have been reviewed and merged into `dev`.

Active work now moves to the public commercial tariff/subscription presentation in `feature/tariff-commercial-copy`.

## Current repository state

`dev` now contains:

- public landing at `/`;
- canonical legal pages `/agreement`, `/offer`, `/personal-data`, `/cookies`;
- permanent legacy redirect `/privacy` → `/personal-data`;
- repository-backed legal revision registry in `config/legal.php`;
- public immutable legal archives;
- current Offer and Personal Data Processing Policy revisions dated 2026-09-14;
- consent-gated Yandex Metrika runtime;
- explicit analytics accept/reject and persistent analytics settings;
- conditional seller/contact rendering;
- automated feature coverage for public legal pages, archives and analytics server-rendering boundaries.

`main` remains at the pre-landing production baseline and must not be promoted until the remaining release gates are complete.

## Active tariff-copy work

The current feature branch replaces the old ambiguous month/year price switch with explicit commercial variants.

For Pro and Premium the public site now distinguishes:

- `Доступ на 1 месяц без автопродления`;
- `Доступ на 12 месяцев без автопродления`;
- `Ежемесячная подписка с автопродлением`;
- `Годовая подписка с автопродлением`.

Each paid option separately shows:

- access period;
- whether auto-renewal is enabled;
- final configured price.

The public wording no longer relies on a generic `Месяц / Год` switch that could hide whether the purchase renews automatically.

Prices remain environment-driven and intentionally empty until the real production checkout amounts are frozen. Eight explicit environment variables are used so access without auto-renewal and auto-renewing subscriptions cannot accidentally share a price merely because they have the same period.

The landing continues to advertise only currently usable product functionality. This work does not add unfinished capabilities to Pro or Premium.

## Analytics checkpoint

The consent runtime is implemented and merged.

Before the production counter ID is enabled, a manual Yandex-side acceptance check still remains:

- confirm Webvisor state;
- verify field/form collection and masking;
- verify URL/query handling;
- verify the production origin;
- confirm no unnecessary personal data is collected.

`YANDEX_METRIKA_COUNTER_ID` must remain empty until this check passes.

## Cross-repository dependencies

Several final rules are implemented in `cropkeeper-app`, not this repository, but the public documents describe them and therefore the behavior must match before release:

- User Agreement acceptance and re-acceptance;
- material Offer-change confirmation;
- auto-renewal disablement and old-price warning;
- recurring-charge email notices;
- refund calculation/processing;
- account deletion;
- export archive generation, 48-hour TTL, post-deletion access and optional email link;
- archive import into a sufficiently empty new account;
- support workflow and retention;
- service-email behavior;
- checkout offers and prices matching the public tariff presentation.

The site owns canonical public legal documents, archives and public tariff wording. The application must use the same legal URLs and commercial definitions.

## Release blockers

The site must not be promoted to `main` or submitted as the final merchant-onboarding website until:

1. tariff/subscription public copy is reviewed, tested and merged;
2. real production checkout variants and prices are reconciled with the landing;
3. the production Yandex counter settings are manually privacy-checked before enabling the counter ID;
4. CloudTips and obsolete support/payment wording are absent from active content;
5. all application legal links use canonical site URLs;
6. cross-repository application behavior materially referenced by the documents is implemented or frozen consistently;
7. landing security/privacy acceptance is complete;
8. open-source dependency/license acceptance is complete;
9. production seller details, contacts and prices are filled with real values.

## Immediate next work

1. Review and locally verify `feature/tariff-commercial-copy`.
2. Merge it into `dev` after approval.
3. Reconcile the landing variants/prices with the final `cropkeeper-app` checkout model.
4. Audit canonical application legal links and remaining cross-repository release behavior.
5. Complete landing security/privacy acceptance and open-source license acceptance.
6. Fill production values and proceed to merchant onboarding.

## Handoff rule

Update this file when the active feature is merged, a release gate closes, the active stage changes, or cross-repository behavior referenced by the legal texts changes.
