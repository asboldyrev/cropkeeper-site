# Cropkeeper Site roadmap

Last updated: 2026-09-16

This roadmap tracks the release sequence for `asboldyrev/cropkeeper-site`. Detailed legal requirements and acceptance criteria live in `docs/LEGAL_AUDIT_PLAN.md`. The current checkpoint lives in `docs/PROJECT_STATUS.md`. The SEO implementation and production-acceptance handoff lives in `docs/SEO_PLAN.md`.

## 1. Initial public landing

Status: completed and merged into `dev`.

Delivered:

- public landing for `cropkeeper.me`;
- conservative current-feature presentation;
- Free / Pro / Premium tariff cards;
- configurable seller/contact values;
- responsive layout and Lucide package integration;
- conditional seller/contact rendering;
- public-page feature tests.

## 2. Canonical legal-document architecture

Status: completed and merged into `dev`.

Delivered:

- `/agreement`, `/offer`, `/personal-data`, `/cookies` canonical active URLs;
- `/privacy` permanent redirect to `/personal-data`;
- `config/legal.php` document/revision registry;
- public archive indexes and immutable archived revision routes;
- historical Privacy Policy revision from 2026-09-05 preserved;
- archive links shown only where a real previous revision exists;
- canonical legal links in the landing and footer;
- public User Agreement and user-facing cookies/analytics document;
- regression tests for canonical pages, archives and redirects.

## 3. Final Offer and Personal Data Policy revision

Status: completed and merged into `dev`.

Delivered:

- previous Offer and Personal Data Processing Policy dated 2026-09-05 frozen into public immutable archives;
- new active revisions dated 2026-09-14;
- final paid-access, auto-renewal, queue/pause, recurring-charge notice and refund wording;
- final locality/coordinates, Open-Meteo, support, service-mail, analytics-consent, export/delete and retention wording;
- public legal copy kept user-facing rather than developer-facing;
- regression coverage for active and archived revisions.

## 4. Consent-gated Yandex Metrika

Status: completed and merged into `dev`.

Delivered:

- explicit accept/reject choice before Metrika initialization;
- persisted consent state and persistent settings action;
- no Metrika script in server-rendered HTML before consent;
- no future initialization after rejection/withdrawal until consent is granted again;
- Webvisor disabled by default;
- explicit pageview without query parameters;
- production counter configured through `YANDEX_METRIKA_COUNTER_ID`;
- regression coverage for the server-rendered consent boundary.

Before enabling the real production counter, manually verify Yandex-side Webvisor/form/masking/URL/origin settings.

## 5. Tariff and subscription-copy finalization

Status: implementation present in the current `dev` line; production price reconciliation remains open.

Delivered/current behavior:

- distinguish `Доступ на 1 месяц без автопродления`;
- distinguish `Доступ на 12 месяцев без автопродления`;
- distinguish `Ежемесячная подписка с автопродлением`;
- distinguish `Годовая подписка с автопродлением`;
- show access period and auto-renewal state separately for every paid option;
- use separate configurable prices for each commercial variant;
- remove the ambiguous month/year UI switch;
- keep unfinished functionality out of commercial cards.

Still required before production onboarding:

- reconcile all displayed prices and variants with the final application checkout.

## 6. SEO hardening

Status: technical implementation completed and merged into `dev`; production acceptance pending.

Canonical handoff: `docs/SEO_PLAN.md`.

Delivered:

- shared SEO metadata architecture in the site layout;
- absolute self-referencing canonical URLs for indexable pages;
- canonical URLs independent of tracking/query parameters;
- `index, follow` for current public pages;
- `noindex, follow` for legal archive indexes and revisions while keeping them public;
- application-owned `/sitemap.xml` containing only canonical indexable pages;
- static `public/robots.txt` referencing the production sitemap;
- Open Graph and Twitter metadata;
- `public/images/app.png` as the initial social preview;
- Cropkeeper SVG/ICO/PNG favicon set and Apple Touch Icon;
- optional landing keywords mechanism and researched landing keyword set;
- landing JSON-LD for `WebSite` and `SoftwareApplication` without unsupported claims/pricing;
- meaningful hero screenshot alt text and loading priority;
- SEO regression tests;
- homepage semantic research and targeted metadata refinement centered on `приложение для огородника`;
- no artificial SEO-text section added;
- international SEO intentionally deferred.

Remaining production acceptance:

- verify final public HTTPS/canonical origin;
- verify public sitemap, robots, redirect and archive noindex behavior;
- submit/monitor sitemap in Google Search Console;
- inspect/index active pages through Google URL Inspection;
- add/verify sitemap in Yandex Webmaster and run its sitemap validator;
- validate rendered JSON-LD;
- verify favicon/social preview from the public origin;
- run PageSpeed Insights mobile/desktop and review Core Web Vitals;
- confirm analytics consent/privacy behavior remains unchanged.

Optional future SEO work, not a current release blocker:

- dedicated 1200×630 social card;
- supported `Organization` / paid `Offer` structured data once production facts are frozen;
- explicit hero image dimensions after reliable measurement;
- additional SEO/content pages only from real demand/query data;
- international SEO when another complete language version exists.

## 7. Canonical legal links and application integration

Status: next planned stage after SEO production acceptance, or earlier if release coordination makes it practical.

Site work:

- verify every public legal link uses a canonical active URL;
- keep active and archived documents accessible without authentication;
- preserve conditional rendering for seller/contact details.

Cross-repository application work in `asboldyrev/cropkeeper-app`:

- point registration, settings, payment and deletion flows to canonical site documents;
- remove or stop using stale independent document copies;
- implement User Agreement acceptance/re-acceptance;
- implement material Offer-change confirmation before a future charge under changed terms;
- notify users about material Personal Data Policy changes without treating the policy as a contract.

## 8. Cross-repository product/legal behavior gate

Status: planned; application-owned implementation with site-document dependency.

Before public launch, application behavior must match the published documents for:

- actual checkout variants and prices;
- auto-renewal default-off and explicit enablement;
- disablement retaining the current paid period until expiry;
- no reuse/re-enable of the same payment binding after disablement;
- new purchase/payment flow required for future auto-renewal;
- old-price-loss warning;
- recurring-charge notice at least 3 calendar days before charge;
- proportional refunds and frozen periods;
- 12-hour current-period threshold and upward kopeck rounding;
- account deletion;
- export archive generation, 48-hour TTL, post-deletion access until original expiry, optional email link and automatic destruction;
- archive import into an otherwise empty account;
- support workflow and retention;
- service-email categories;
- material document-change notifications and required confirmations.

## 9. Landing security and privacy acceptance

Status: planned before release.

Verify:

- HTTPS and HSTS ownership/configuration;
- appropriate cookie attributes;
- no server secrets in frontend output/build;
- clear dev/production separation;
- no real user data in development;
- analytics consent behavior under first visit, accept, reject, withdrawal and later visits;
- production Yandex counter settings match the legal/privacy model;
- archived legal revisions cannot be accidentally rewritten by ordinary active-document updates.

## 10. Open-source license acceptance

Status: planned before release.

Scope:

- inventory Composer and npm dependencies;
- identify licenses;
- review AGPL/GPL/LGPL dependencies separately;
- add required notices/license texts/attributions where applicable;
- record the accepted result for the release.

## 11. Merchant onboarding and production promotion

Status: blocked on SEO production acceptance, stages 7–10 and remaining production-value reconciliation.

After SEO/legal/security/license gates are complete:

- fill production seller details and contacts;
- fill actual paid tariff prices;
- deploy the public `cropkeeper.me` candidate;
- perform final public smoke checks;
- complete SEO production validation and submit sitemaps to search-engine webmaster tools;
- submit the site for production payment-provider merchant onboarding;
- coordinate provider-requested wording changes without weakening the legal-audit requirements;
- only after acceptance and final verification, promote the approved release from `dev` to `main`.

## Post-release maintenance

For every new legal revision:

- keep the canonical active URL stable;
- create an immutable archived revision before replacing active content;
- preserve the old revision verbatim;
- update the archive registry;
- trigger the appropriate application notification/re-acceptance flow when the change is material;
- never edit an archived revision retroactively.

For SEO maintenance:

- keep sitemap URLs aligned with canonical/indexable routes;
- preserve archive `noindex` behavior;
- validate structured data after material landing/tariff changes;
- update homepage keyword targeting only from real search-demand/query data, not keyword stuffing;
- monitor Search Console and Yandex Webmaster after launch;
- revisit international SEO only when another complete language version is introduced.
