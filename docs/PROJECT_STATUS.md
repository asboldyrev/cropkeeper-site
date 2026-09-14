# Current project status

Last updated: 2026-09-14

## Active stage

Legal hardening of the public Cropkeeper site before production payment-provider onboarding.

The first landing implementation is complete and merged into `dev`. The next release work is no longer the initial landing build itself: the site must now be brought in line with the final legal-audit requirements before payment-provider onboarding, production promotion, or public launch.

## Current repository state

`dev` contains the completed first landing baseline. `main` is still at the pre-landing baseline and must not be promoted until the remaining release gates below are complete.

Current public site capabilities on `dev`:

- public landing at `/`;
- public tariff presentation for Free / Pro / Premium with production-specific paid prices supplied from environment configuration;
- public seller/contact details supplied from environment configuration;
- contact and seller fields are rendered only when the corresponding value is present;
- public legal pages at `/offer`, `/privacy`, and `/personal-data`;
- shared public layout, responsive styling and Lucide icons from the npm package;
- automated feature coverage for public pages and conditional contact rendering.

The original `feature/payment-provider-landing` branch was merged into `dev` on 2026-09-09 and removed afterwards. New work must branch from the current `dev` according to gitflow.

## Legal-document checkpoint

The existing legal pages are a first-release baseline, not the final legally audited document set.

The final legal audit now requires a broader public-document architecture than is currently implemented. In particular, the current repository does **not** yet provide:

- a public User Agreement;
- a dedicated cookies / Yandex Metrika document or section;
- version metadata and public archives for every legal document;
- immutable historical document revisions;
- a shared canonical-document architecture intended to be used by both the landing and the application;
- Yandex Metrika consent UI and consent-gated loading;
- the final audited subscription, auto-renewal and refund wording;
- the final wording for account deletion, data export/import, support, service mail and related data-processing flows.

The current `/offer`, `/privacy`, and `/personal-data` URLs remain useful candidates for canonical active-document URLs, but their content and versioning model must be revised before production launch.

## Product-copy checkpoint

The landing copy was already corrected to avoid advertising partially implemented functionality as currently available. The current presentation is intentionally conservative about gardens, recommendations and recurring tasks.

The legal audit adds another copy requirement: paid access must distinguish clearly between access without auto-renewal and subscriptions with auto-renewal. The term `разовая подписка` must not be used.

The final tariff presentation must use end-user wording such as:

- access for 1 month without auto-renewal;
- access for 12 months without auto-renewal;
- monthly subscription with auto-renewal;
- annual subscription with auto-renewal.

The page must show the access period and whether auto-renewal is enabled as separate properties and must continue to avoid unpublished or incomplete features.

## Analytics checkpoint

Yandex Metrika is planned for the landing but is not accepted as an unconditional page-load dependency.

The final rule is explicit opt-in:

- Metrika must not initialize before positive consent;
- continuing to browse is not consent;
- the user must be able to accept or reject;
- the choice must be persisted;
- the user must be able to change or withdraw the choice later;
- after withdrawal Metrika must not initialize on subsequent visits unless consent is given again.

Before enabling Metrika, Webvisor, field masking, URL/query capture and the absence of unnecessary personal data must be verified.

## Cross-repository dependencies

Several requirements from the final legal audit describe application behavior and therefore cannot be completed only in `cropkeeper-site`.

They must be coordinated with `asboldyrev/cropkeeper-app`, including:

- User Agreement acceptance and re-acceptance;
- material Offer-change acceptance before future recurring charges;
- subscription auto-renewal enable/disable UX and old-price warning;
- account deletion without the former six-month deactivation model;
- user-data export, 48-hour archive lifecycle, optional email link and access after account deletion until the original `expires_at`;
- archive import during new registration;
- the new technical-support workflow and support-message retention;
- service email behavior;
- document-change notifications.

The landing repository owns the canonical public documents, their archives, legal navigation, public tariff wording, cookie/Metrika consent and landing-specific security/license checks. The application must link to these canonical public URLs instead of maintaining independent stale copies.

## Release blockers

The site must not be promoted to `main` or submitted as the final merchant-onboarding website until the following gates are closed:

1. final legal documents are prepared and published through the canonical/versioned architecture;
2. public immutable archives are implemented;
3. CloudTips and obsolete support/payment wording are absent from all active documents and public copy;
4. Yandex Metrika is consent-gated and documented;
5. tariff/subscription wording matches the final product/payment model;
6. all legal links use canonical public URLs and are available without authentication;
7. cross-repository application requirements that materially affect the legal texts are either implemented or their exact final behavior is frozen;
8. technical security review of the landing is complete;
9. open-source dependency/license review is complete;
10. production seller details, contacts and paid prices are filled with real values.

## Immediate next work

The implementation plan is maintained in `docs/LEGAL_AUDIT_PLAN.md`. The high-level execution order is maintained in `docs/ROADMAP.md`.

The next implementation stage is the legal-document architecture and final document content. Payment-provider onboarding and production promotion come **after** this legal-hardening stage.

## Handoff rule

Update this file when a release gate closes, the active stage changes, a new genuine blocker is discovered, or the cross-repository behavior required by the legal texts is materially changed.
