# Cropkeeper Site roadmap

Last updated: 2026-09-14

This roadmap tracks the release sequence for `asboldyrev/cropkeeper-site`. Detailed legal requirements and acceptance criteria live in `docs/LEGAL_AUDIT_PLAN.md`. The current checkpoint lives in `docs/PROJECT_STATUS.md`.

## 1. Initial public landing

Status: completed and merged into `dev`.

Delivered:

- public landing for `cropkeeper.me`;
- conservative current-feature presentation;
- Free / Pro / Premium tariff cards;
- configurable seller/contact values and paid prices;
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

Status: in progress in `feature/legal-content-revision`.

Current scope:

- freeze the previously published Offer dated 2026-09-05 into the public archive;
- freeze the previously published Personal Data Processing Policy dated 2026-09-05 into the public archive;
- publish new active revisions dated 2026-09-14;
- align the Offer with access without auto-renewal, auto-renewing subscriptions, queue/pause semantics, disable/re-purchase rules, recurring-charge notices and the final refund model;
- align the Personal Data Policy with locality/coordinates, Open-Meteo, payment metadata, support, service mail, analytics consent, export/delete flows and retention rules;
- keep all public legal wording directed to the user, not to the developer;
- expand automated coverage for active and archived revisions.

## 4. Consent-gated Yandex Metrika

Status: planned after stage 3.

Scope:

- explicit accept/reject choice before Metrika initialization;
- no implied consent through continued browsing;
- persisted consent state;
- public mechanism to review/change/withdraw the choice;
- no initialization on future visits after withdrawal unless consent is granted again;
- Webvisor review;
- sensitive-field masking review;
- URL/query-parameter review;
- verification that email, user content and other unnecessary personal data do not enter analytics;
- runtime behavior matching the published Cookies and Personal Data documents.

## 5. Tariff and subscription-copy finalization

Status: planned.

Scope:

- remove the term `разовая подписка` if present;
- distinguish `доступ на 1 месяц без автопродления`, `доступ на 12 месяцев без автопродления`, `ежемесячная подписка с автопродлением`, and `годовая подписка с автопродлением`;
- show access period and auto-renewal state separately;
- reconcile public paid prices with application checkout;
- publish only functionality actually ready for users;
- keep internal development wording out of commercial cards.

## 6. Canonical legal links and application integration

Status: planned.

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

## 7. Cross-repository product/legal behavior gate

Status: planned; application-owned implementation with site-document dependency.

Before public launch, application behavior must match the published documents for:

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

## 8. Landing security and privacy acceptance

Status: planned before release.

Verify:

- HTTPS and HSTS ownership/configuration;
- appropriate cookie attributes;
- no server secrets in frontend output/build;
- clear dev/production separation;
- no real user data in development;
- analytics consent behavior under first visit, accept, reject, withdrawal and later visits;
- archived legal revisions cannot be accidentally rewritten by ordinary active-document updates.

## 9. Open-source license acceptance

Status: planned before release.

Scope:

- inventory Composer and npm dependencies;
- identify licenses;
- review AGPL/GPL/LGPL dependencies separately;
- add required notices/license texts/attributions where applicable;
- record the accepted result for the release.

## 10. Merchant onboarding and production promotion

Status: blocked on stages 3–9.

After legal/security/license gates are complete:

- fill production seller details and contacts;
- fill actual paid tariff prices;
- deploy the public `cropkeeper.me` candidate;
- perform final public smoke checks;
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
