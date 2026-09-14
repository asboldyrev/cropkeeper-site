# Current project status

Last updated: 2026-09-14

## Active stage

Legal hardening of the public Cropkeeper site before production payment-provider onboarding.

The canonical legal-document architecture and the final substantive Offer / Personal Data Processing Policy revision have been reviewed and merged into `dev`. Active work now moves to consent-gated Yandex Metrika in `feature/metrika-consent`.

## Current repository state

`dev` now contains:

- public landing at `/`;
- canonical legal pages `/agreement`, `/offer`, `/personal-data`, `/cookies`;
- permanent legacy redirect `/privacy` → `/personal-data`;
- repository-backed legal revision registry in `config/legal.php`;
- public immutable archive routes under `/legal/{document}/archive`;
- archived Privacy Policy, Offer and Personal Data Processing Policy revisions from 2026-09-05;
- current Offer and Personal Data Processing Policy revisions dated 2026-09-14;
- canonical legal navigation in the landing and footer;
- conditional seller/contact rendering;
- automated feature coverage for public legal pages and archive behavior.

`main` remains at the pre-landing production baseline and must not be promoted until the remaining release gates are complete.

## Analytics-consent work

The active feature branch adds the runtime consent model already described in the public Cookies and Personal Data documents.

Target behavior:

- Yandex Metrika is not included in server-rendered HTML and does not initialize before consent;
- first-time visitors receive a clear accept/reject choice;
- continued browsing is not treated as consent;
- the decision is stored locally together with a consent-policy version;
- rejection prevents Metrika from loading on future visits;
- the footer provides a persistent `Настройки аналитики` action so the visitor can change the choice later;
- withdrawing consent stops the initialized counter and prevents future initialization until consent is given again;
- Webvisor is disabled by default;
- automatic initial pageview sending is disabled and the explicit pageview URL excludes query parameters;
- the production counter ID is supplied through `YANDEX_METRIKA_COUNTER_ID`; with no ID configured, analytics runtime/UI is disabled.

Before release, the real Yandex-side counter settings still require a manual acceptance check: Webvisor, form/field collection, masking, URL behavior and the actual production origin.

## Product-copy checkpoint

The next site-specific content stage after analytics consent is commercial tariff/subscription copy.

The final tariff presentation must distinguish clearly between:

- access for 1 month without auto-renewal;
- access for 12 months without auto-renewal;
- monthly subscription with auto-renewal;
- annual subscription with auto-renewal.

The page must show access period and auto-renewal state separately, must not use `разовая подписка`, and must not advertise unfinished functionality.

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
- service-email behavior.

The site owns canonical public legal documents and archives. The application must link to these URLs rather than maintaining stale copies.

## Release blockers

The site must not be promoted to `main` or submitted as the final merchant-onboarding website until:

1. consent-gated Yandex Metrika runtime is reviewed, tested and merged;
2. the production Yandex counter settings are manually privacy-checked before enabling the counter ID;
3. tariff/subscription public copy matches the final commercial model and real checkout prices;
4. CloudTips and obsolete support/payment wording are absent from active content;
5. all application legal links use canonical site URLs;
6. cross-repository application behavior materially referenced by the documents is implemented or frozen consistently;
7. landing security/privacy acceptance is complete;
8. open-source dependency/license acceptance is complete;
9. production seller details, contacts and prices are filled with real values.

## Immediate next work

1. Review and locally verify `feature/metrika-consent`.
2. Merge it into `dev` after approval.
3. Finalize tariff/subscription copy.
4. Continue with canonical-link application integration and remaining release gates.

## Handoff rule

Update this file when the active feature is merged, a release gate closes, the active stage changes, or cross-repository behavior referenced by the legal texts changes.
