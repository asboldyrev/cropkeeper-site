# Current project status

Last updated: 2026-09-16

## Active stage

The public Cropkeeper landing is implemented, published to production at `https://cropkeeper.me`, and accepted for the current release baseline.

The landing-side legal, SEO, analytics/privacy, tariff presentation, security/privacy and open-source license checks are considered complete for this checkpoint. The remaining release work is cross-repository verification against the current `cropkeeper-app` implementation and any final application-owned behavior that must match the published site documents and commercial wording.

`docs/SEO_PLAN.md` records the completed SEO implementation and the production PageSpeed baseline. `docs/ROADMAP.md` remains the release-sequence overview.

## Current repository and production state

`dev` contains and production currently exposes:

- public landing at `/`;
- canonical legal pages `/agreement`, `/offer`, `/personal-data`, `/cookies`;
- permanent `/privacy` → `/personal-data` redirect;
- repository-backed legal revision registry in `config/legal.php`;
- public immutable legal archives;
- current Offer and Personal Data Processing Policy revisions dated 2026-09-14;
- consent-gated Yandex Metrika runtime;
- explicit analytics accept/reject and persistent analytics settings;
- configured Yandex Metrika and Yandex Webmaster on the production site;
- no Google Analytics by product decision;
- conditional seller/contact rendering;
- explicit paid-access variants with and without auto-renewal;
- production tariff/checkout values reconciled for the current release checkpoint;
- expanded product roadmap copy;
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

`main` remains the release branch and should only be updated according to the project's normal release flow after the remaining cross-repository application gate is closed.

## Landing production acceptance

The landing is considered production-accepted for the current checkpoint.

Confirmed/accepted:

- production site is published at `https://cropkeeper.me`;
- production SEO implementation is live;
- Yandex Webmaster is configured;
- Yandex Metrika is configured under the consent model used by the site;
- Google Analytics will not be added;
- production tariff presentation and checkout reconciliation are considered complete;
- landing security/privacy acceptance is considered complete;
- open-source dependency/license acceptance is considered complete;
- PageSpeed/Lighthouse production results are strong and do not expose a release-blocking performance, SEO or best-practices issue.

Google Search Console is optional operational tooling for this project and is not required to close the current landing release gate. It is separate from Google Analytics and may be connected later if Google-specific indexing/query diagnostics are wanted.

## PageSpeed / Lighthouse production baseline

Report date: 2026-09-16, production origin `https://cropkeeper.me/`.

### Mobile

- Performance: **98**;
- Accessibility: **96**;
- Best Practices: **100**;
- SEO: **100**;
- Agentic Browsing: **2/2**;
- First Contentful Paint: **1.0 s**;
- Largest Contentful Paint: **1.2 s**;
- Total Blocking Time: **0 ms**;
- Cumulative Layout Shift: **0**;
- Speed Index: **3.9 s**.

### Desktop

- Performance: **98**;
- Accessibility: **96**;
- Best Practices: **100**;
- SEO: **100**;
- Agentic Browsing: **2/2**;
- First Contentful Paint: **0.3 s**;
- Largest Contentful Paint: **0.3 s**;
- Total Blocking Time: **0 ms**;
- Cumulative Layout Shift: **0.099**;
- Speed Index: **0.4 s**.

The production baseline therefore meets the release targets for LCP and CLS. Desktop CLS is very close to the `0.1` boundary, so future visual/layout work should avoid worsening it.

At the time of the report, PageSpeed showed **No Data** under real-user experience / CrUX field data. This is not treated as a blocker; field Core Web Vitals should be monitored later when sufficient real-user data becomes available.

### Non-blocking Lighthouse findings

The report also surfaced improvement opportunities that are not release blockers for the current landing:

- render-blocking requests, with estimated savings around **300 ms mobile** and **80 ms desktop**;
- small image-delivery savings, approximately **6 KiB mobile** and **14 KiB desktop**;
- image elements without explicit `width` / `height` values;
- a contrast issue causing Accessibility to score **96** rather than 100;
- mobile Speed Index of **3.9 s**, despite LCP remaining strong at **1.2 s**.

These should be treated as future polish/performance work. In particular, explicit image dimensions and the contrast issue are reasonable low-risk follow-ups if the landing is edited again. They do not justify reopening the current production acceptance by themselves.

## SEO checkpoint

The technical SEO implementation and production acceptance are complete for the current landing release baseline.

Implemented/live:

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
- SEO regression tests were added and verified during implementation;
- Lighthouse SEO score is **100** on both mobile and desktop in the accepted production report.

Future SEO work is maintenance/optimization rather than a current release blocker: monitor Yandex Webmaster, optionally connect Google Search Console, revisit query targeting from real search data, and validate structured data/social previews after material landing changes.

## Analytics checkpoint

Yandex Metrika is configured on production and uses the site's explicit consent flow. Yandex Webmaster is also configured.

Google Analytics is intentionally not part of the project and should not be introduced as an implied requirement in future checklists.

Any future analytics change must preserve the current privacy rule: analytics must not initialize before explicit consent.

## Commercial/tariff checkpoint

The landing distinguishes the intended paid variants for Pro and Premium:

- `Доступ на 1 месяц без автопродления`;
- `Доступ на 12 месяцев без автопродления`;
- `Ежемесячная подписка с автопродлением`;
- `Годовая подписка с автопродлением`.

Each paid option separately shows access period, auto-renewal state and configured final price. The production tariff/checkout reconciliation is considered complete for this landing checkpoint.

Future changes to application checkout, pricing or renewal rules must trigger a new site/application reconciliation before release.

## Remaining cross-repository gate

The main remaining release task is to verify the current `cropkeeper-app` `dev` branch against what the production site already publishes.

The verification must use the current application code rather than assuming the older roadmap is still accurate. Check, at minimum:

- canonical legal links from registration, settings, payment and deletion flows;
- User Agreement acceptance and re-acceptance;
- material Offer-change confirmation;
- Personal Data Policy change notifications where applicable;
- checkout variants and prices matching the site;
- auto-renewal default/enable/disable behavior and old-price warning;
- recurring-charge email notices;
- refund calculation/processing rules;
- account deletion;
- export archive generation, 48-hour TTL, post-deletion access and optional email link;
- archive import eligibility/behavior;
- support workflow and retention;
- service-email behavior.

The purpose of this stage is to find only real remaining differences in the current application, not to reimplement requirements that are already present.

## Immediate next work

1. Merge this documentation checkpoint into `dev`.
2. Treat the landing itself as complete for the current release baseline.
3. Switch to `asboldyrev/cropkeeper-app`, read its current `dev` from `AGENTS.md`, and perform the final cross-repository legal/commercial behavior audit against the production site.
4. Implement only discrepancies that still exist in the current application.
5. After the cross-repository gate is green, perform the normal final release/promotion flow.

## Handoff rule

Update this file when the cross-repository gate closes, a production behavior materially changes, or the public legal/commercial wording changes.

For SEO-specific maintenance, update `docs/SEO_PLAN.md` only when the accepted production baseline, search targeting, indexing policy or SEO implementation materially changes.
