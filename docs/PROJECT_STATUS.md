# Current project status

Last updated: 2026-09-16

## Active stage

SEO hardening of the public Cropkeeper site is the immediate active task before continuing the remaining production-release gates.

The canonical legal-document architecture, final substantive Offer / Personal Data Processing Policy revision, consent-gated Yandex Metrika runtime, explicit tariff variants, and expanded user-facing product roadmap are present in the current `dev` line.

The complete SEO audit decisions, implementation order, and restart checklist are recorded in `docs/SEO_PLAN.md`. Treat that document as the canonical handoff source for the SEO phase.

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
- explicit paid-access variants with and without auto-renewal;
- expanded roadmap copy describing current and planned Cropkeeper capabilities;
- automated feature coverage for public legal pages, archives and analytics server-rendering boundaries.

`main` remains at the pre-landing production baseline and must not be promoted until the remaining release gates are complete.

## SEO checkpoint

The SEO audit of the current `dev` identified a sound server-rendered baseline but incomplete search-engine metadata and indexing infrastructure.

Agreed work includes:

- shared SEO metadata support in the site layout;
- self-referencing absolute canonicals for indexable public pages;
- explicit `noindex, follow` for legal archive indexes and archived revisions while keeping them publicly accessible;
- application-owned `/sitemap.xml` containing only canonical indexable pages;
- a sitemap reference in `robots.txt`;
- Open Graph and Twitter metadata;
- initial use of `public/images/app.png` as the social preview image, with a dedicated 1200x630 card deferred;
- replacement of the current empty favicon with Cropkeeper application logo assets supplied by the user (`logo.svg` / `logo.png`) and compatible favicon/touch-icon markup;
- optional `meta keywords` support for the landing as a Yandex-oriented supplemental signal, with final phrases chosen only after keyword research;
- JSON-LD for the landing (`WebSite`, `SoftwareApplication`, and only supported organization data);
- no paid structured-data prices until production checkout prices are frozen and reconciled;
- explicit review of the hero screenshot `alt` instead of changing it mechanically;
- SEO regression tests;
- later Wordstat/SERP research followed by targeted title/H1/description/hero refinements;
- production validation in Google Search Console, Yandex Webmaster, structured-data validators, and PageSpeed Insights.

The expanded landing roadmap already provides substantial natural topical coverage. Do not add a separate keyword-heavy "SEO text" section during this phase.

International SEO is intentionally deferred until a real second-language version exists.

See `docs/SEO_PLAN.md` for the full rationale, target URL policy, acceptance criteria, and new-chat restart sequence.

## Commercial/tariff checkpoint

For Pro and Premium the public site distinguishes:

- `Доступ на 1 месяц без автопродления`;
- `Доступ на 12 месяцев без автопродления`;
- `Ежемесячная подписка с автопродлением`;
- `Годовая подписка с автопродлением`.

Each paid option separately shows:

- access period;
- whether auto-renewal is enabled;
- final configured price.

Prices remain environment-driven and intentionally empty until the real production checkout amounts are frozen. Eight explicit environment variables are used so access without auto-renewal and auto-renewing subscriptions cannot accidentally share a price merely because they have the same period.

The landing continues to advertise only currently usable product functionality in commercial cards. Future capabilities are presented separately in the roadmap.

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

1. SEO foundation and production SEO acceptance are complete;
2. real production checkout variants and prices are reconciled with the landing;
3. the production Yandex counter settings are manually privacy-checked before enabling the counter ID;
4. CloudTips and obsolete support/payment wording are absent from active content;
5. all application legal links use canonical site URLs;
6. cross-repository application behavior materially referenced by the documents is implemented or frozen consistently;
7. landing security/privacy acceptance is complete;
8. open-source dependency/license acceptance is complete;
9. production seller details, contacts and prices are filled with real values.

## Immediate next work

1. Complete the documentation-only SEO checkpoint in `feature/seo-foundation`.
2. Before application-code changes, satisfy the current `AGENTS.md` Laravel Boost bootstrap requirement in a proper local repository environment and reread the generated instructions.
3. Implement the SEO plan in the order defined in `docs/SEO_PLAN.md`: metadata architecture, canonical/indexation policy, sitemap/robots, favicons, social metadata, optional keywords, structured data, image decision, and regression tests.
4. Perform keyword research and only then make targeted homepage copy adjustments.
5. Run production SEO acceptance after deployment.
6. Return to the remaining commercial, cross-repository, security/privacy, license, and merchant-onboarding gates.

## Handoff rule

Update this file when the active feature is merged, a release gate closes, the active stage changes, or cross-repository behavior referenced by the legal texts changes.

For SEO-specific continuation, also update `docs/SEO_PLAN.md` whenever an agreed SEO decision, implementation order, or acceptance criterion changes.
