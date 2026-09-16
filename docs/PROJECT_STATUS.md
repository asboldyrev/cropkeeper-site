# Current project status

Last updated: 2026-09-16

## Active stage

The technical SEO hardening of the public Cropkeeper site is complete in `dev`.

The immediate SEO task is now production acceptance after deployment to the final public origin. Once production SEO acceptance is closed, continue with the remaining commercial, cross-repository, security/privacy, license and merchant-onboarding gates.

`docs/SEO_PLAN.md` is the canonical SEO handoff source. It now reflects the implemented state and the remaining production checklist.

## Current repository state

`dev` now contains:

- public landing at `/`;
- canonical legal pages `/agreement`, `/offer`, `/personal-data`, `/cookies`;
- permanent `/privacy` → `/personal-data` redirect;
- repository-backed legal revision registry in `config/legal.php`;
- public immutable legal archives;
- current Offer and Personal Data Processing Policy revisions dated 2026-09-14;
- consent-gated Yandex Metrika runtime;
- explicit analytics accept/reject and persistent analytics settings;
- conditional seller/contact rendering;
- explicit paid-access variants with and without auto-renewal;
- expanded product roadmap copy;
- Laravel Boost project guidance;
- shared SEO metadata architecture;
- absolute self-referencing canonical URLs for indexable pages;
- `index, follow` for active public pages and `noindex, follow` for legal archives;
- application-owned `/sitemap.xml` containing only indexable canonical pages;
- static `public/robots.txt` referencing the production sitemap;
- Open Graph and Twitter metadata;
- Cropkeeper favicon/touch-icon assets;
- landing JSON-LD for `WebSite` and `SoftwareApplication`;
- researched homepage semantic targeting and landing-only meta keywords;
- meaningful hero screenshot alt/loading attributes;
- automated regression coverage for the SEO contracts above.

`main` remains at the pre-landing production baseline and must not be promoted until the remaining release gates are complete.

## SEO checkpoint

### Implemented and merged into `dev`

- shared title/description/keywords/canonical/robots/social metadata handling;
- self-referencing absolute canonicals based on `APP_URL`;
- query/UTM parameters excluded from canonical URLs;
- legal archives stay public but output `noindex, follow`;
- `/privacy` remains a permanent redirect and is absent from sitemap;
- `/sitemap.xml` contains only `/`, `/agreement`, `/offer`, `/personal-data`, `/cookies`;
- `robots.txt` references `https://cropkeeper.me/sitemap.xml`;
- Open Graph and Twitter metadata use `public/images/app.png` as the initial social image;
- non-empty favicon set derived from the Cropkeeper application logo;
- landing JSON-LD for `WebSite` and `SoftwareApplication` without invented ratings/prices;
- homepage target centered on `приложение для огородника`, with secondary diary/journal/plants/seeds/season-planning semantics;
- current H1 kept natural instead of forcing exact-match keyword copy;
- hero screenshot uses meaningful alt text, high fetch priority and async decoding;
- SEO regression tests added and locally verified during each implementation stage.

### Still pending: production acceptance

After deploying the SEO-complete candidate to the final public origin:

- verify production `APP_URL`, HTTPS host and rendered canonical URLs;
- verify sitemap and robots responses from the public server;
- verify archive `noindex` in rendered HTML;
- submit sitemap in Google Search Console;
- use Google URL Inspection for homepage and active legal pages;
- add/verify the site and sitemap in Yandex Webmaster;
- run Yandex Sitemap validator;
- validate rendered JSON-LD;
- verify social preview and favicon from the public origin;
- run PageSpeed Insights mobile and desktop;
- confirm the SEO/layout work did not weaken consent-gated analytics behavior.

The expanded landing roadmap already provides substantial natural topical coverage. Do not add a separate keyword-heavy SEO text block.

International SEO remains deferred until a real second-language version exists.

## Commercial/tariff checkpoint

For Pro and Premium the public site distinguishes:

- `Доступ на 1 месяц без автопродления`;
- `Доступ на 12 месяцев без автопродления`;
- `Ежемесячная подписка с автопродлением`;
- `Годовая подписка с автопродлением`.

Each paid option separately shows access period, auto-renewal state and configured final price.

Prices remain environment-driven and intentionally empty until the real production checkout amounts are frozen. Eight explicit environment variables prevent subscription and non-renewing access variants from accidentally sharing values merely because they use the same duration.

The landing advertises only currently usable functionality in commercial cards. Future capabilities remain separated in the roadmap.

## Analytics checkpoint

The consent runtime is implemented and merged.

Before enabling the production Yandex counter ID, a manual Yandex-side acceptance check still remains:

- confirm Webvisor state;
- verify field/form collection and masking;
- verify URL/query handling;
- verify the production origin;
- confirm no unnecessary personal data is collected.

`YANDEX_METRIKA_COUNTER_ID` must remain empty until this check passes.

## Cross-repository dependencies

Several release requirements are implemented in `cropkeeper-app`, not this repository, but public site documents describe them and therefore behavior must match before release:

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

1. production SEO acceptance is complete;
2. real production checkout variants and prices are reconciled with the landing;
3. production Yandex counter settings are manually privacy-checked before enabling the counter ID;
4. CloudTips and obsolete support/payment wording are absent from active content;
5. all application legal links use canonical site URLs;
6. cross-repository application behavior materially referenced by the documents is implemented or frozen consistently;
7. landing security/privacy acceptance is complete;
8. open-source dependency/license acceptance is complete;
9. production seller details, contacts and prices are filled with real values.

## Immediate next work

1. Merge the final SEO documentation checkpoint.
2. Deploy an SEO-complete candidate to the final public origin when the wider release state allows it.
3. Run the production SEO acceptance checklist from `docs/SEO_PLAN.md`.
4. Return to canonical application legal-link integration and the cross-repository product/legal behavior gate.
5. Complete security/privacy, license and merchant-onboarding acceptance.

## Handoff rule

Update this file when a release gate closes, the active stage changes, or cross-repository behavior referenced by public legal/commercial text changes.

For SEO-specific continuation, update `docs/SEO_PLAN.md` when production acceptance items close or search targeting materially changes.
