# Final legal audit implementation plan

Last updated: 2026-09-14

Source: final legal-audit fixes supplied for Cropkeeper on 2026-09-14.

This document translates the final legal-audit requirements into an implementation plan for `asboldyrev/cropkeeper-site` and explicitly marks requirements that are owned by `asboldyrev/cropkeeper-app` but must be reflected by the public site documents.

## Fixed decisions

The following decisions are treated as final requirements for this release plan:

- Roskomnadzor notification work is outside this repository plan.
- CloudTips is removed from the new Cropkeeper version.
- `cropkeeper.me` is the single public source of current legal documents for both the landing and the application.
- Yandex Metrika may initialize only after explicit visitor consent.
- previous legal revisions remain publicly available and immutable.

## Implementation principles

1. Active legal URLs are stable canonical URLs. Updating a document must not require changing the URL used by the application.
2. Historical revisions are immutable release artifacts. A published archive version is never edited retroactively.
3. The site must describe real/frozen behavior, not planned behavior presented as if it already exists.
4. Legal pages must remain publicly readable without authentication.
5. Personal Data Processing Policy is an informational policy, not a user contract that must be accepted.
6. Explicit acceptance is implemented only for documents/changes where acceptance is actually required.
7. Any application behavior referenced by legal text must be cross-checked with `cropkeeper-app` before the legal revision is declared final.

---

## Work package A — canonical legal-document system

Priority: critical.

### Target public documents

Canonical active pages:

- `/agreement` — User Agreement;
- `/offer` — Public Offer / paid-access terms;
- `/personal-data` — Personal Data Processing Policy;
- `/cookies` — cookies and Yandex Metrika policy/notice;
- separate consent page(s) only when consent is the actual processing basis.

`/privacy` must be reviewed during implementation. The final architecture should avoid contradictory overlapping privacy documents. Either keep it as a clearly defined complementary privacy notice or redirect/consolidate it into the canonical Personal Data Processing Policy if the approved legal text makes the separate page redundant.

### Version model

Each active document must have:

- a stable document code;
- a human-readable revision date and, preferably, an explicit revision/version identifier;
- canonical active URL;
- archive index URL;
- link from the active page to its archive.

Recommended site structure:

```text
/legal/{document}/archive
/legal/{document}/archive/{revision}
```

Examples:

```text
/legal/agreement/archive
/legal/agreement/archive/2026-09-14
/legal/offer/archive
/legal/offer/archive/2026-09-14
```

The exact archive path may differ, but it must be permanent and deterministic.

### Storage approach

Prefer repository-backed immutable Blade/Markdown/PHP content for legal revisions instead of mutable database content for the first release. This gives every published revision a Git history and makes accidental production editing harder.

Recommended implementation options, in order of preference:

1. versioned Blade partials/views plus a document registry config;
2. versioned Markdown source rendered by the application;
3. database-backed content only if a real editorial workflow is later required and immutability is enforced separately.

The registry should identify the current revision and all archived revisions for each document. Historical revision content must never be overwritten when a new active revision is published.

### Acceptance criteria

- all canonical active URLs return 200 without authentication;
- every active legal page shows revision metadata;
- every active legal page links to its archive;
- archive index lists all previous revisions with date/version;
- archive revision page clearly states that the revision is archived and no longer current;
- archived content remains unchanged after publishing a newer revision;
- footer/legal navigation uses only canonical active URLs.

### Tests

Add feature tests for:

- active-document availability;
- archive-index availability;
- archived-revision availability;
- archive warning text;
- correct active revision metadata;
- legal-link canonical URLs;
- absence of authentication redirects.

---

## Work package B — final legal content

Priority: critical.

The active documents must be rewritten from the final approved legal texts, not patched sentence-by-sentence from the current draft.

### User Agreement

Must cover at minimum:

- account creation and access rules;
- acceptable use of the web application;
- user-generated content and responsibility for that content;
- service availability and product changes;
- support interaction;
- account deletion;
- export/import flows where relevant to user rights/usage;
- service communications;
- material amendments and re-acceptance rules where rights/obligations change.

### Offer / paid-access terms

Must cover at minimum:

- Free / Pro / Premium;
- paid access without auto-renewal;
- auto-renewing subscription;
- explicit auto-renew opt-in;
- disablement semantics;
- new-purchase requirement to enable auto-renewal again;
- old-price-loss warning mechanics;
- current queue/pause behavior for paid periods;
- exact refund policy from work package E;
- payment-provider timing caveat for actual crediting of refunds;
- service emails connected to billing/subscription;
- material Offer changes and confirmation before a future charge under changed material terms.

### Personal Data Processing Policy

Must describe actual processing including:

- account data;
- locality and approximate coordinates;
- user content categories as applicable;
- Open-Meteo interaction;
- payment/subscription metadata;
- support messages and retention;
- service email processing;
- export archive generation and temporary storage;
- archive email delivery when selected;
- import flow where relevant;
- account deletion consequences;
- Yandex Metrika categories/processing after consent;
- cookies/localStorage used for consent state and other site needs;
- retention/deletion rules;
- processors/third parties actually used in production.

The Policy must not be framed as a contract that the user is required to accept.

### Cookies / Yandex Metrika page

Must describe:

- necessary browser storage if used;
- consent-state storage;
- Yandex Metrika;
- categories of collected data;
- purposes;
- storage/retention where known/required;
- how consent is granted;
- how it is refused;
- how it can later be withdrawn/changed;
- effect of withdrawal on future visits.

### Remove obsolete content

Active documents and public copy must not contain:

- CloudTips;
- voluntary tips/donations;
- `Поблагодарить разработчика` flows;
- Telegram as the primary support channel if the new support model replaces it.

Archived revisions are exempt: their historical text must remain untouched.

---

## Work package C — public archive of revisions

Priority: critical.

Implementation should be completed with work package A.

### Required behavior

For every legal document:

- active page contains `Архив редакций` link;
- archive page lists previous versions;
- every item shows revision date/version;
- archived page prominently says it is historical and not current;
- archived pages link back to the current document;
- publishing a new revision automatically/explicitly moves the former active revision into the immutable archive set.

### Release process

Before changing an active legal document in a release:

1. copy/freeze the current active text into a new immutable archive revision if it is not already archived;
2. add that revision to the document registry/archive index;
3. add the new active revision;
4. verify active and archive URLs;
5. run legal-page regression tests;
6. only then deploy.

---

## Work package D — Yandex Metrika consent model

Priority: high.

### Runtime requirements

Metrika must not be loaded/initialized until the visitor explicitly chooses `Принять`.

The consent UI must provide equivalent clear choices:

- accept analytics;
- reject analytics.

Continued browsing, scrolling or closing an informational block must not count as consent.

### Consent persistence

Store a minimal consent state locally. The implementation must distinguish at least:

- no decision;
- accepted;
- rejected.

The site must expose a persistent way to reopen privacy/cookie settings and change the decision later.

After withdrawal/rejection, a later page load/visit must not initialize Metrika unless consent is granted again.

### Recommended technical design

- keep Metrika tag/bootstrap out of the initial server-rendered HTML or make it inert until consent;
- use one small consent manager module in `resources/js`;
- store only the consent decision/version needed to respect the visitor's choice;
- when accepted, inject/initialize Metrika once;
- when rejected/withdrawn, do not initialize it on later loads;
- if provider cookies already exist from a previous accepted session, document and implement the practical cleanup behavior available to the site.

### Privacy review before enablement

Explicitly verify:

- Webvisor is either disabled or configured consistently with the legal decision;
- fields are masked where necessary;
- query parameters do not contain email, tokens or user content;
- no seller/admin/test secrets are sent;
- no application-authenticated user content is exposed by landing analytics;
- only the intended public landing origin is tracked.

### Tests

Automated/browser tests should cover:

- first visit: Metrika absent before decision;
- reject: Metrika remains absent;
- subsequent visit after reject: Metrika remains absent;
- accept: Metrika initializes;
- subsequent visit after accept: consent is honored;
- withdraw: later visit does not initialize Metrika;
- consent-settings control remains accessible.

---

## Work package E — final refund rules

Priority: high.

The Offer must state the deterministic refund model supplied by legal counsel.

### Base formula

```text
refund = actually_paid_period_price × unused_time / total_paid_period_time
```

Use the amount actually paid for that concrete purchase. Do not use the current tariff price when refunding an older purchase. Discounts are therefore naturally preserved in the calculation base.

### Periodic auto-renewing subscription

- active paid period: refund proportionally for unused remainder;
- paused/frozen remaining paid time is included in the refund basis;
- a fully unstarted frozen paid period is refunded in full;
- active use of the application by itself is not a reason to refuse the refund.

### Access without auto-renewal

Use the same proportional model:

- within the first 7 days as the stated refund rule;
- after 7 days Cropkeeper voluntarily keeps the same proportional scheme.

### Time counting

- paid-day boundaries are measured from the exact activation timestamp;
- each following day starts 24 hours after the preceding boundary;
- for the current incomplete 24-hour interval use the 12-hour threshold:
  - less than 12 hours elapsed — that current day is not counted as used;
  - 12 hours or more elapsed — that current day is counted as used.

### Rounding

Round the final refund amount **up** to the nearest kopeck in favor of the user.

### Refund deadline

When refund grounds exist, refund no later than 7 calendar days from the user's request. The Offer should separately explain that actual bank/provider crediting may take additional time outside Cropkeeper's direct control.

`Рассматривается индивидуально` may remain only for additional voluntary cases beyond these predefined rules.

### Cross-repository application requirement

`cropkeeper-app` must implement or otherwise operationally support the same calculation before this wording is declared final. Site text and application refund behavior must not diverge.

Required application regression cases include:

- discounted purchase;
- old historical price vs current price;
- active period partial refund;
- paused period partial refund;
- fully unstarted frozen period;
- <12h current-day boundary;
- >=12h current-day boundary;
- upward kopeck rounding.

---

## Work package F — auto-payment rules

Priority: high.

The Offer and user-facing purchase copy must state:

- auto-renewal is off by default;
- enabling it requires an explicit user action;
- disabling it does not terminate the current paid access period;
- after disablement the current period continues as access without auto-renewal until its end;
- the payment binding for that period is no longer used for recurring charges;
- the same period cannot simply switch auto-renewal back on;
- future auto-renewal requires a new purchase/new subscription and a new explicit payment flow.

### Old-price warning

When the existing recurring price is lower than the current new-subscription price, the application must show before disablement:

- current recurring price;
- current price of a new subscription;
- explicit warning that the old price cannot be restored by simply turning auto-renewal back on.

This is application-owned UX, but the rule must be documented in the Offer and User Agreement as appropriate.

---

## Work package G — tariff and subscription public copy

Priority: high.

The landing must not use `разовая подписка`.

User-facing commercial variants should be named consistently as:

- `Доступ на 1 месяц без автопродления`;
- `Доступ на 12 месяцев без автопродления`;
- `Ежемесячная подписка с автопродлением`;
- `Годовая подписка с автопродлением`.

For every paid offer show separately:

- access period;
- auto-renewal: yes/no;
- final price.

Do not mix implementation notes, development roadmap or incomplete capabilities into commercial tariff cards.

Before merchant review, public tariff values must match the actual `cropkeeper-app` checkout offers exactly.

---

## Work package H — export archive legal flow

Priority: high; cross-repository implementation dependency.

The documents and application UX must consistently state:

- export is initiated by the user;
- generated archive is retained for 48 hours;
- the user is informed about the 48-hour lifetime before/when generating it;
- deleting the account does not extend that TTL;
- an already generated archive may remain accessible after account deletion until its original `expires_at`;
- after expiry the generated file is automatically destroyed;
- the user may choose to receive the archive link by email;
- after downloading, the user is responsible for secure storage of the downloaded copy;
- no separate additional consent is required solely for this 48-hour technical retention when the flow is transparently described.

`cropkeeper-app` must provide the actual export, TTL enforcement, post-deletion access model, optional email link and import-on-new-registration behavior before the final site documents assert that the workflow is available.

---

## Work package I — document-change notification and acceptance

Priority: medium; largely cross-repository.

### User Agreement

When a material change affects a current user's rights/obligations, require a new explicit acceptance in the application.

### Offer

If material terms affecting an active recurring subscription change:

- notify the user in advance by email;
- require explicit confirmation in the application;
- do not perform the next charge under materially changed terms without that confirmation.

### Personal Data Processing Policy

Do not require acceptance as if it were a contract. For material changes, notify the user appropriately.

### Timing

Use 7–14 days as the normal advance-notice target for material changes unless the change legitimately must take effect immediately.

### Site support

The legal-document registry should expose revision/version metadata in a form the application can reference. If needed later, add a small public machine-readable endpoint for current legal revision IDs, but do not add an API until the application integration actually needs it.

---

## Work package J — service mail vs advertising

Priority: medium; cross-repository behavior plus public legal wording.

The current release scope must not introduce advertising mailings.

Service mail may cover:

- registration;
- security;
- payments;
- auto-renewal;
- refunds;
- account deletion;
- data export;
- technical support.

Do not add advertising upsell content to service emails.

The Personal Data Processing Policy/User Agreement/Offer should describe the relevant service-message categories without misclassifying them as marketing consent.

---

## Work package K — CloudTips removal audit

Priority: critical cleanup.

Search the active site source, configuration, legal documents, tests and public copy for:

- `CloudTips`;
- `чаевые`;
- `поблагодарить`;
- old donation/support CTA references.

All active references must be removed.

Do not edit an archived historical legal revision merely because it contains a historically accurate CloudTips reference.

A repository regression/search check should be added if practical to prevent active CloudTips copy from being reintroduced.

---

## Work package L — canonical link audit

Priority: high.

After the final document architecture exists, audit all site pages and the application integration:

- footer links;
- landing trust/legal block;
- tariff/payment copy;
- account/registration/payment legal links in `cropkeeper-app`;
- email links where legal documents are referenced;
- any static or help content.

Rules:

- active references point only to canonical active URLs;
- archive URLs are used only when intentionally linking to a historical revision;
- no legal page requires login;
- every legal page links to its archive;
- contact/requisite fields continue to render only when their values are set.

---

## Work package M — landing security acceptance

Priority: release gate.

Verify before production:

- HTTPS is mandatory;
- HSTS ownership is intentional and tested;
- cookies/localStorage use is documented and secure for its purpose;
- any server-set cookies use appropriate `Secure`, `HttpOnly` and `SameSite` attributes where applicable;
- no server credentials/secrets appear in rendered HTML or compiled frontend assets;
- dev and production configuration are separated;
- development environments contain no real user data;
- analytics does not initialize before consent;
- legal archive routing cannot expose arbitrary files/path traversal;
- error pages/debug output do not expose secrets;
- `APP_DEBUG=false` in production.

Document the result in the release/PR verification notes. Add automated checks where practical; keep TLS/HSTS/real deployment checks in the deployment smoke procedure.

---

## Work package N — open-source license acceptance

Priority: release gate.

Inventory at minimum:

- Composer production/runtime dependencies;
- npm runtime/frontend dependencies;
- fonts/assets/icons bundled or loaded by the site.

For each dependency record:

- package;
- version;
- license;
- whether attribution/notice/source obligations apply to distribution/deployment.

Review AGPL/GPL/LGPL separately before release. Add required notice/license files or attribution pages where applicable.

The result should be reproducible from the lockfiles used for the release.

---

## Recommended implementation sequence

### Phase 1 — legal truth freeze

1. Confirm/freeze application behavior that the legal texts depend on, especially auto-renewal, refunds, support, deletion and export/import.
2. Obtain/finalize approved legal texts for User Agreement, Offer, Personal Data Processing Policy and cookies/Metrika.
3. Identify any consent text that must exist separately because consent is the actual legal basis.

### Phase 2 — document platform

4. Implement canonical document registry/version metadata.
5. Implement User Agreement and cookies/Metrika routes.
6. Implement archive indexes and immutable archived revisions.
7. Add archive/current navigation and tests.
8. Remove active CloudTips/obsolete-support wording.

### Phase 3 — commercial/privacy UI

9. Replace tariff/subscription wording with the final four commercial variants.
10. Implement consent-gated Yandex Metrika and privacy settings.
11. Audit all canonical legal links and conditional contacts.

### Phase 4 — application integration

12. Update `cropkeeper-app` links to canonical site documents.
13. Implement required acceptance/re-acceptance and notification mechanics.
14. Implement/finalize auto-renewal disablement warning/rules.
15. Implement/finalize deterministic refunds.
16. Implement/finalize account deletion, export/import, support retention and service-email behavior.
17. Reconcile final public legal texts with the implemented application behavior.

### Phase 5 — release gates

18. Run site and cross-repository regression tests.
19. Run landing security acceptance.
20. Run open-source license review.
21. Fill real seller/contact/payment values.
22. Deploy `cropkeeper.me` release candidate and smoke test all public/legal/archive/consent flows.
23. Submit the resulting site for payment-provider onboarding.
24. Promote the approved site release from `dev` to `main` only after all preceding gates pass.

---

## Definition of done

The legal-audit stage is complete only when:

- all required current documents exist at stable public URLs;
- each document has current revision metadata and a public immutable archive;
- final content matches actual Cropkeeper behavior;
- no active CloudTips/obsolete support wording remains;
- Yandex Metrika never initializes without explicit consent;
- consent can be refused and later withdrawn;
- tariff/subscription wording matches actual checkout offers and renewal semantics;
- refund rules are deterministic in both the Offer and application behavior;
- export/delete/support/service-mail wording matches implemented flows;
- material document-change behavior is implemented where required;
- all legal links are canonical and public;
- conditional contact rendering remains intact;
- security acceptance passes;
- license acceptance passes;
- production seller/contact/pricing values are filled;
- automated and manual release checks pass.
