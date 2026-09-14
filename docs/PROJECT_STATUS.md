# Current project status

Last updated: 2026-09-14

## Active stage

Legal hardening of the public Cropkeeper site before production payment-provider onboarding.

The canonical legal-document architecture has been reviewed and merged into `dev`. The active work now moves to the substantive legal-content revision in `feature/legal-content-revision`.

## Current repository state

`dev` now contains:

- public landing at `/`;
- canonical legal pages `/agreement`, `/offer`, `/personal-data`, `/cookies`;
- permanent legacy redirect `/privacy` → `/personal-data`;
- repository-backed legal revision registry in `config/legal.php`;
- public archive index/revision routes under `/legal/{document}/archive`;
- archived Privacy Policy revision from 2026-09-05;
- canonical legal navigation in the landing and footer;
- conditional seller/contact rendering;
- automated feature coverage for public legal pages and archive behavior.

`main` remains at the pre-landing production baseline and must not be promoted until the remaining release gates are complete.

## Active legal-content work

The current feature branch freezes the previous 2026-09-05 Offer and Personal Data Processing Policy into immutable archives and introduces new active revisions dated 2026-09-14.

The new Offer is being aligned with the final agreed product/legal model for:

- paid access with and without auto-renewal;
- explicit auto-renewal opt-in;
- disablement without terminating the already paid period;
- no simple re-enable after disablement; a new purchase/payment flow is required;
- old recurring price warning before disablement;
- queue/pause semantics for already paid periods;
- email notice at least 3 calendar days before recurring charge;
- deterministic proportional refunds from the actually paid amount;
- paused/frozen paid-period refunds;
- 12-hour threshold for the current incomplete 24-hour period;
- upward rounding to the nearest kopeck in the user's favor;
- refund completion no later than 7 calendar days where grounds exist;
- material Offer changes requiring advance email notice and explicit in-app confirmation before charging under changed terms.

The new Personal Data Processing Policy is being aligned with the final data-flow model for:

- account data and user content;
- locality and approximate coordinates;
- Open-Meteo server-side weather requests with locality coordinates only;
- subscription/payment metadata;
- technical logs including IP/user-agent;
- technical support and service mail;
- support retention: ordinary requests up to 1 year after closure; payment/refund/legal disputes longer, with a three-year reference period;
- Yandex Metrika only after explicit consent;
- export archive generation and 48-hour retention, including access after account deletion until the original expiry;
- optional archive-link delivery by email;
- deletion of active account data and continued storage only where a separate lawful basis remains.

The public documents remain user-facing documents. Internal implementation instructions must not appear in their text.

## Product-copy checkpoint

The landing still needs a separate commercial-copy pass after the legal-content revision.

The final tariff presentation must distinguish clearly between:

- access for 1 month without auto-renewal;
- access for 12 months without auto-renewal;
- monthly subscription with auto-renewal;
- annual subscription with auto-renewal.

The page must show access period and auto-renewal state separately, must not use `разовая подписка`, and must not advertise unfinished functionality.

## Analytics checkpoint

Yandex Metrika consent behavior is documented but runtime integration is not yet implemented.

Required runtime behavior remains:

- no Metrika initialization before positive consent;
- explicit accept and reject actions;
- persisted decision;
- ability to change or withdraw the decision later;
- no initialization on later visits after rejection/withdrawal until consent is granted again;
- Webvisor, masking and URL/query review before enablement.

## Cross-repository dependencies

Several final rules are implemented in `cropkeeper-app`, not this repository, but the public documents describe them and therefore the behavior must match before release:

- User Agreement acceptance/re-acceptance;
- material Offer-change confirmation;
- auto-renewal disablement and old-price warning;
- recurring-charge email notices;
- refund calculation/processing;
- account deletion;
- export archive generation, 48-hour TTL, post-deletion access and optional email link;
- archive import into a sufficiently empty new account;
- support workflow and retention;
- service-email behavior.

The site owns canonical public legal documents and archives. The application must link to these URLs rather than maintaining stale copies.

## Release blockers

The site must not be promoted to `main` or submitted as the final merchant-onboarding website until:

1. the new Offer and Personal Data Processing Policy are reviewed, tested and merged;
2. all superseded published legal revisions are preserved in the public archive;
3. CloudTips and obsolete support/payment wording are absent from active content;
4. Yandex Metrika consent runtime is implemented and verified;
5. tariff/subscription public copy matches the final commercial model and real checkout prices;
6. all application legal links use canonical site URLs;
7. cross-repository application behavior materially referenced by the documents is implemented or frozen consistently;
8. landing security/privacy acceptance is complete;
9. open-source dependency/license acceptance is complete;
10. production seller details, contacts and prices are filled with real values.

## Immediate next work

1. Review and locally verify `feature/legal-content-revision`.
2. Merge it into `dev` after approval.
3. Implement consent-gated Yandex Metrika.
4. Finalize tariff/subscription copy.
5. Continue with canonical-link application integration and remaining release gates.

## Handoff rule

Update this file when the active feature is merged, a release gate closes, the active stage changes, or cross-repository behavior referenced by the legal texts changes.
