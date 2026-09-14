# Current project status

Last updated: 2026-09-14

## Active stage

Legal hardening of the public Cropkeeper site before production payment-provider onboarding.

The first landing implementation is complete and merged into `dev`. Work has started on the first legal-hardening package in `feature/legal-document-architecture`.

## Current repository state

`dev` contains the completed first landing baseline. `main` is still at the pre-landing baseline and must not be promoted until the remaining release gates below are complete.

The active feature branch introduces the first canonical legal-document architecture:

- `/agreement` — canonical User Agreement;
- `/offer` — canonical Public Offer;
- `/personal-data` — canonical Personal Data Processing Policy;
- `/cookies` — canonical cookies / Yandex Metrika document;
- `/privacy` — legacy permanent redirect to `/personal-data` instead of a second active privacy policy;
- `config/legal.php` as the registry of document codes, active revisions and archived revisions;
- public archive routes under `/legal/{document}/archive` and `/legal/{document}/archive/{revision}`;
- the former Privacy Policy revision dated 2026-09-05 preserved as an archived historical revision;
- canonical legal navigation in the landing trust block and footer;
- feature coverage for canonical pages, redirects, archive indexes, archived revisions and missing revisions.

This work remains feature-branch state until locally verified and merged into `dev`.

## Legal-document checkpoint

The architecture work is now in progress, but the substantive legal-content gate is not yet closed.

The new User Agreement and cookies/analytics document are being introduced from the final legal-audit requirements. The existing Offer and Personal Data Processing Policy still require a new substantive revision that incorporates the final audited model for:

- access without auto-renewal and auto-renewing subscriptions;
- final disable/re-enable auto-payment rules;
- deterministic refund rules and frozen paid periods;
- support retention and service-email flows;
- locality / approximate coordinates and Open-Meteo;
- account deletion and 48-hour export archive behavior;
- material document changes and re-acceptance rules where required;
- Yandex Metrika processing after explicit consent.

When either current document is substantively replaced, its previously published current revision must first be frozen into the repository-backed archive and then registered in `config/legal.php`.

## Product-copy checkpoint

The landing copy was already corrected to avoid advertising partially implemented functionality as currently available. The current presentation is intentionally conservative about gardens, recommendations and recurring tasks.

The remaining commercial-copy requirement is to distinguish clearly between:

- access for 1 month without auto-renewal;
- access for 12 months without auto-renewal;
- monthly subscription with auto-renewal;
- annual subscription with auto-renewal.

The page must show access period and auto-renewal state as separate properties, must not use `разовая подписка`, and must continue to avoid unpublished or incomplete features.

## Analytics checkpoint

Yandex Metrika remains unimplemented and must not be added as an unconditional page-load dependency.

Final rule:

- Metrika does not initialize before positive consent;
- continuing to browse is not consent;
- accept and reject are both available;
- the decision is persisted;
- the visitor can later change or withdraw the decision;
- after rejection/withdrawal Metrika stays disabled on later visits until consent is granted again.

Before enablement, Webvisor, field masking, URL/query capture and unnecessary personal-data leakage must be checked.

## Cross-repository dependencies

Several requirements from the final legal audit describe application behavior and cannot be completed only in `cropkeeper-site`.

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

The landing repository owns canonical public documents, archive publication, legal navigation, public tariff wording, cookie/Metrika consent and landing-specific security/license checks. The application must link to these canonical public URLs instead of maintaining independent stale copies.

## Release blockers

The site must not be promoted to `main` or submitted as the final merchant-onboarding website until the following gates are closed:

1. canonical/versioned legal architecture is merged and verified;
2. final substantive legal documents are prepared and published;
3. public immutable archives are complete for every superseded published revision;
4. CloudTips and obsolete support/payment wording are absent from active content;
5. Yandex Metrika is consent-gated and documented;
6. tariff/subscription wording matches the final product/payment model;
7. all legal links use canonical public URLs and are available without authentication;
8. cross-repository application requirements that materially affect the legal texts are implemented or their exact final behavior is frozen;
9. technical security review of the landing is complete;
10. open-source dependency/license review is complete;
11. production seller details, contacts and paid prices are filled with real values.

## Immediate next work

1. Finish and locally verify `feature/legal-document-architecture`.
2. Merge it into `dev` after review.
3. Start the substantive Offer and Personal Data Processing Policy revision, freezing the existing published revisions into the archive first.
4. Then proceed to Yandex Metrika consent and commercial tariff/subscription copy.

Payment-provider onboarding and production promotion remain after the legal-hardening stage.

## Handoff rule

Update this file when a release gate closes, the active stage changes, a new genuine blocker is discovered, or the cross-repository behavior required by the legal texts is materially changed.
