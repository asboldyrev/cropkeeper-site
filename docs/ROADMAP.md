# Cropkeeper Site roadmap

Last updated: 2026-09-14

This roadmap tracks the release sequence for `asboldyrev/cropkeeper-site`. Detailed legal requirements and acceptance criteria live in `docs/LEGAL_AUDIT_PLAN.md`. The current checkpoint lives in `docs/PROJECT_STATUS.md`.

## 1. Initial public landing

Status: completed and merged into `dev`.

Delivered:

- public landing for `cropkeeper.me`;
- current product description and conservative feature presentation;
- Free / Pro / Premium tariff cards;
- configurable production seller/contact values and paid prices;
- responsive public layout;
- Lucide package integration;
- public Offer, Privacy Policy and Personal Data Processing Policy baseline;
- conditional rendering of contact and seller fields;
- public-page feature tests.

## 2. Final legal-document architecture

Status: next.

This stage must be completed before the remaining production/payment-provider stages.

Scope:

- add the User Agreement;
- finalize the Offer / paid-access terms;
- finalize the Personal Data Processing Policy;
- define the cookies / Yandex Metrika document or dedicated policy section;
- introduce explicit document revision identifiers/dates;
- keep canonical active-document URLs stable;
- implement public archive indexes and immutable archived revisions;
- add archive links to every active legal page;
- make the landing the shared public legal source for both site and application;
- ensure the Personal Data Policy is informative and is not presented as a contract that must be accepted;
- include separate consent documents only where consent is actually the legal basis.

## 3. Final legal-content synchronization with Cropkeeper behavior

Status: planned immediately after/alongside stage 2.

Scope:

- Free / Pro / Premium;
- account and web-application rules;
- user content;
- paid access without auto-renewal;
- auto-renewing subscriptions;
- auto-payment enable/disable/re-purchase rules;
- warning about loss of an old recurring price after auto-renewal is disabled;
- current paid-period queue/pause semantics;
- final proportional-refund rules;
- new support workflow and support-message retention;
- account deletion without six-month deactivation;
- user-data export/import and 48-hour generated-archive lifecycle;
- optional archive-link email;
- service mail;
- locality and approximate coordinates;
- Open-Meteo;
- Yandex Metrika;
- material document changes and re-acceptance/notification rules.

CloudTips, voluntary tips/donations and obsolete Telegram-primary-support wording must be removed from active documents and active public copy. Historical archived revisions must never be rewritten to remove old historical wording.

## 4. Consent-gated Yandex Metrika

Status: planned.

Scope:

- explicit accept/reject choice before Metrika initialization;
- no implied consent through continued browsing;
- persistent consent state;
- public mechanism to review/change/withdraw the choice;
- no Metrika initialization on future visits after withdrawal unless consent is granted again;
- Webvisor review;
- sensitive-field masking review;
- URL/query-parameter review;
- verification that email, user content and other unnecessary personal data do not enter analytics;
- corresponding legal-document wording for data categories, storage technologies, purposes, periods, consent and withdrawal.

## 5. Tariff and subscription-copy finalization

Status: planned.

Scope:

- remove the term `разовая подписка`;
- distinguish `доступ на 1 месяц без автопродления`, `доступ на 12 месяцев без автопродления`, `ежемесячная подписка с автопродлением`, and `годовая подписка с автопродлением`;
- show access period and auto-renewal state separately;
- ensure paid pricing matches the application checkout;
- publish only functionality actually ready for users;
- keep internal roadmap/development wording out of tariff sales copy.

## 6. Canonical legal links and application integration

Status: planned.

Site work:

- use only canonical active-document URLs throughout the site;
- keep active documents public without authentication;
- link every legal page to its archive;
- preserve conditional rendering for seller/contact details.

Cross-repository application work in `asboldyrev/cropkeeper-app`:

- link application legal UI to the same canonical URLs;
- remove independent stale document copies where present;
- implement required User Agreement acceptance/re-acceptance;
- implement material Offer-change confirmation before a future charge under changed terms;
- notify users about material Personal Data Policy changes without treating the policy itself as a contract.

## 7. Cross-repository product/legal behavior gate

Status: planned; application-owned implementation with site documentation dependency.

Before final legal publication, freeze or implement the exact behavior for:

- auto-renewal default-off and explicit enablement;
- disablement keeping the paid period active until expiry;
- no reuse/re-enable of the same payment binding after disablement;
- new purchase/payment flow required to start auto-renewal again;
- old-price-loss warning showing both the current recurring price and the current price of a new subscription;
- proportional refunds including paused/frozen paid periods;
- exact paid-time calculation and rounding rules;
- account deletion behavior;
- export archive generation, 48-hour TTL, access after account deletion until original expiry, optional email delivery and automatic destruction;
- archive import on new registration;
- support workflow and retention;
- service-email categories;
- document-change notifications and required confirmations.

The site must not document a behavior as final until the application behavior is frozen or implemented consistently.

## 8. Landing security and privacy acceptance

Status: planned before release.

Verify:

- HTTPS;
- HSTS ownership/configuration;
- appropriate cookie attributes;
- no server secrets in frontend output/build;
- clear dev/production separation;
- no real user data in development;
- analytics consent is respected under first visit, accept, reject, withdrawal and subsequent-visit scenarios;
- public legal archives cannot be accidentally rewritten by ordinary active-document updates.

## 9. Open-source license acceptance

Status: planned before release.

Scope:

- inventory Composer and npm dependencies;
- identify licenses;
- review AGPL/GPL/LGPL dependencies separately;
- add required notices/license texts/attributions where applicable;
- record the accepted result for the release.

## 10. Merchant onboarding and production promotion

Status: blocked on stages 2–9.

After legal/security/license gates are complete:

- fill production seller details and contacts;
- fill actual paid tariff prices;
- deploy the public `cropkeeper.me` candidate;
- perform final public smoke checks;
- submit the site for production payment-provider merchant onboarding;
- coordinate any provider-requested wording changes without weakening the legal-audit requirements;
- only after acceptance and final verification, promote the approved site release from `dev` to `main`.

## Post-release maintenance

Legal documents are versioned release artifacts. For every new revision:

- keep the canonical active URL stable;
- create a new immutable archived revision before replacing the active content;
- preserve the old revision verbatim;
- update the archive index;
- trigger the appropriate application notification/re-acceptance flow when the change is material;
- never edit an archived revision retroactively.
