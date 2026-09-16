# Cropkeeper Site roadmap

Last updated: 2026-09-16

This roadmap tracks the release sequence for `asboldyrev/cropkeeper-site`. Detailed legal requirements and acceptance criteria live in `docs/LEGAL_AUDIT_PLAN.md`. The current checkpoint lives in `docs/PROJECT_STATUS.md`. The completed SEO implementation and production baseline live in `docs/SEO_PLAN.md`.

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

Status: completed, merged and production-configured.

Delivered:

- explicit accept/reject choice before Metrika initialization;
- persisted consent state and persistent settings action;
- no Metrika script in server-rendered HTML before consent;
- no future initialization after rejection/withdrawal until consent is granted again;
- Webvisor disabled by default in application config;
- explicit pageview without query parameters;
- production counter configuration;
- Yandex Metrika configured on the production site;
- Yandex Webmaster configured;
- regression coverage for the server-rendered consent boundary.

Google Analytics is intentionally not used and must not be treated as a missing release requirement.

## 5. Tariff and subscription-copy finalization

Status: completed for the current production landing baseline.

Delivered/current behavior:

- distinguish `Доступ на 1 месяц без автопродления`;
- distinguish `Доступ на 12 месяцев без автопродления`;
- distinguish `Ежемесячная подписка с автопродлением`;
- distinguish `Годовая подписка с автопродлением`;
- show access period and auto-renewal state separately for every paid option;
- use separate configurable prices for each commercial variant;
- remove the ambiguous month/year UI switch;
- keep unfinished functionality out of commercial cards;
- production tariff values and checkout presentation reconciled for the current checkpoint.

Any later application pricing/checkout change requires a new site/application reconciliation.

## 6. SEO hardening

Status: completed, deployed and production-accepted.

Canonical handoff: `docs/SEO_PLAN.md`.

Delivered:

- shared SEO metadata architecture;
- absolute self-referencing canonical URLs;
- explicit indexation policy and `noindex, follow` legal archives;
- application-owned `/sitemap.xml`;
- production sitemap reference in `robots.txt`;
- Open Graph and Twitter metadata;
- initial `public/images/app.png` social preview;
- Cropkeeper favicon/touch-icon set;
- concise landing `meta keywords` support and researched keyword set;
- landing JSON-LD for `WebSite` and `SoftwareApplication` without unsupported claims;
- meaningful hero screenshot alt/loading behavior;
- SEO regression tests;
- homepage semantic research centered on `приложение для огородника`;
- Yandex Webmaster production setup;
- PageSpeed/Lighthouse production acceptance.

Accepted PageSpeed baseline on 2026-09-16:

- Mobile: Performance 98, Accessibility 96, Best Practices 100, SEO 100, FCP 1.0 s, LCP 1.2 s, TBT 0 ms, CLS 0, Speed Index 3.9 s;
- Desktop: Performance 98, Accessibility 96, Best Practices 100, SEO 100, FCP 0.3 s, LCP 0.3 s, TBT 0 ms, CLS 0.099, Speed Index 0.4 s.

Non-blocking future polish is recorded in `docs/SEO_PLAN.md`: render-blocking resources, small image-delivery savings, explicit image dimensions, contrast, and later field Core Web Vitals monitoring once CrUX data exists.

International SEO remains deferred until a genuine second-language version exists.

## 7. Canonical legal links and application integration

Status: next active cross-repository verification stage.

Site side is considered complete for the current landing baseline. The remaining work is to inspect the current `asboldyrev/cropkeeper-app` `dev` and verify that application flows use the production site's canonical legal/commercial model.

Check in the application:

- registration, settings, payment and deletion flows point to canonical site documents;
- stale independent document copies are not used as authoritative active documents;
- User Agreement acceptance/re-acceptance behavior matches published rules;
- material Offer-change confirmation works where required;
- material Personal Data Policy changes are notified without treating the policy as a contract.

Do not assume older roadmap items are still missing; verify the current application code first.

## 8. Cross-repository product/legal behavior gate

Status: open; this is the main remaining release gate.

Verify the current application behavior against the production site for:

- actual checkout variants and prices;
- auto-renewal default-off and explicit enablement;
- disablement retaining the current paid period until expiry;
- no reuse/re-enable of the same payment binding after disablement where prohibited by the agreed flow;
- new purchase/payment flow required for future auto-renewal where applicable;
- old-price-loss warning;
- recurring-charge notice at least 3 calendar days before charge;
- proportional refunds and frozen periods;
- 12-hour current-period threshold and upward kopeck rounding;
- account deletion;
- export archive generation, 48-hour TTL, post-deletion access until original expiry, optional email link and automatic destruction;
- archive import into an otherwise sufficiently empty account;
- support workflow and retention;
- service-email categories;
- material document-change notifications and required confirmations.

The goal is to identify only real remaining differences in the current `cropkeeper-app`, not to repeat already completed work.

## 9. Landing security and privacy acceptance

Status: completed for the current production landing baseline.

Accepted checkpoint includes the production HTTPS/security/privacy setup, dev/production separation, analytics consent behavior and production analytics/privacy configuration.

Reopen this stage only if infrastructure, cookie behavior, analytics collection or legal/privacy requirements materially change.

## 10. Open-source license acceptance

Status: completed for the current landing release baseline.

Dependency/license review is considered closed for the current site release. Re-run it after material Composer/npm dependency changes or before a later release if dependency composition changes substantially.

## 11. Final release / merchant / promotion flow

Status: pending only on the remaining cross-repository application gate and normal final release verification.

The landing itself is already published to production and accepted for the current baseline. After stages 7–8 are green:

- perform final application/site smoke verification;
- confirm no last-minute legal/commercial divergence exists;
- complete any remaining merchant/provider operational step, if applicable;
- promote/update release branches according to the project's normal release process.

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
- monitor Yandex Webmaster;
- optionally connect Google Search Console if Google-specific diagnostics are desired;
- monitor Core Web Vitals when sufficient field data becomes available;
- preserve or improve the accepted PageSpeed baseline;
- revisit international SEO only when another complete language version is introduced.
