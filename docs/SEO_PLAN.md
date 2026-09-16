# Cropkeeper Site SEO plan

Last updated: 2026-09-16

This document is the canonical SEO handoff for `asboldyrev/cropkeeper-site`.

The SEO implementation is complete, deployed to production at `https://cropkeeper.me`, and accepted for the current release baseline. Future work in this document is maintenance/optimization unless a regression or changed product requirement appears.

## 1. Accepted production state

Production currently has:

- server-rendered Laravel/Blade landing and legal pages;
- canonical active public pages at `/`, `/agreement`, `/offer`, `/personal-data`, `/cookies`;
- permanent `/privacy` → `/personal-data` redirect;
- public legal archives with `noindex, follow`;
- absolute self-referencing canonical URLs for indexable pages;
- canonical URLs that ignore query/UTM parameters;
- `/sitemap.xml` containing only canonical indexable pages;
- static `public/robots.txt` allowing crawling and referencing `https://cropkeeper.me/sitemap.xml`;
- shared title, description, robots, canonical, Open Graph and Twitter metadata;
- landing-only `meta keywords` as a small Yandex-oriented supplemental signal;
- Open Graph/Twitter image based on `public/images/app.png`;
- Cropkeeper favicon set: SVG, ICO, PNG and Apple Touch Icon;
- landing JSON-LD with `WebSite` and `SoftwareApplication`;
- no invented rating/review/install/price structured data;
- meaningful hero screenshot alt text, `fetchpriority="high"` and async decoding;
- SEO regression tests covering canonical/indexation, sitemap/robots, social metadata, structured data, favicon assets, homepage metadata and hero image behavior;
- Yandex Webmaster configured;
- Yandex Metrika configured under the site's consent model;
- no Google Analytics by product decision.

The site remains Russian-only. International SEO is out of scope until a real second-language version exists.

## 2. Indexation and canonical policy

### Indexable

The following pages are intended to be indexed and use self-referencing absolute canonical URLs:

- `/`;
- `/agreement`;
- `/offer`;
- `/personal-data`;
- `/cookies`.

Canonical base host is controlled through `APP_URL`; production uses `https://cropkeeper.me`.

### Redirect

`/privacy` permanently redirects to `/personal-data` and is excluded from the sitemap.

### Legal archives

Legal archive indexes and revisions remain public for transparency but are not search landing pages:

- `/legal/{document}/archive` → `noindex, follow`;
- `/legal/{document}/archive/{revision}` → `noindex, follow`;
- archive URLs are excluded from the sitemap.

Do not make archive pages private merely to keep them out of search.

## 3. Sitemap and robots

`/sitemap.xml` is application-owned and contains only:

- `/`;
- `/agreement`;
- `/offer`;
- `/personal-data`;
- `/cookies`.

It intentionally omits redirects and legal archives.

`robots.txt` remains static in `public/` because the production nginx configuration serves `robots.txt` as a static asset instead of passing it to Laravel. It allows crawling and references the production sitemap URL.

If the production host ever changes, update both `APP_URL` and the static sitemap reference in `public/robots.txt`.

## 4. Shared metadata architecture

`resources/views/layouts/site.blade.php` centralizes:

- title;
- meta description;
- optional keywords;
- robots directive;
- canonical URL;
- Open Graph metadata;
- Twitter metadata;
- favicon/touch-icon links;
- landing structured data.

Special pages can override indexation/canonical behavior through view data where necessary.

## 5. Homepage semantic targeting

Primary topic:

- `приложение для огородника`.

Secondary semantic support:

- `дневник огородника`;
- `журнал огородника`;
- `учет растений`;
- `учет семян`;
- `планирование огородного сезона`.

Current homepage metadata:

- title: `Cropkeeper — приложение для огородника и дневник сезона`;
- description: `Cropkeeper — приложение для огородника: ведите растения и посадки, семена, задачи, календарь и журнал наблюдений в одном месте.`;
- concise landing-only `meta keywords` matching the semantic groups above.

Do not make `планировщик огорода` the primary topic while the product does not provide garden-bed/site planning. Do not make `календарь огородника` the primary topic while users commonly expect ready-made planting/lunar recommendations rather than a personal event/task calendar.

The H1 and hero copy are intentionally natural rather than exact-match keyword copy.

Exact Yandex Wordstat volume was not publicly available during research, so no search-volume numbers were invented. Future targeting changes should come from real Yandex Webmaster data and, if later connected, Google Search Console data.

## 6. Structured data

The landing emits JSON-LD for:

- `WebSite`;
- `SoftwareApplication`.

Supported fields include Cropkeeper name, canonical URL, page description, Russian language, web operating system and application category.

Currently excluded intentionally:

- `Organization` unless public seller/brand facts justify it;
- paid `Offer` data unless there is a concrete SEO reason and values remain exactly synchronized with production checkout;
- ratings, reviews, awards, install counts or other unsupported claims.

Revalidate rendered JSON-LD after material landing/schema changes.

## 7. Images and social preview

`public/images/app.png` currently serves two roles:

- landing hero screenshot;
- initial Open Graph / Twitter social image.

Hero image behavior:

- alt: `Интерфейс Cropkeeper с данными огородного сезона`;
- `fetchpriority="high"`;
- `decoding="async"`.

A dedicated 1200×630 branded social card remains optional future work.

The current markup does not hard-code image `width` / `height`. The accepted PageSpeed report explicitly flags missing explicit image dimensions as a diagnostic opportunity. Adding reliable dimensions later is a reasonable low-risk optimization, especially because desktop CLS is close to the target boundary.

## 8. Favicons

Current public assets include:

- `favicon.svg`;
- `favicon.ico`;
- `favicon-32x32.png`;
- `apple-touch-icon.png`.

The shared layout references all of them. Keep the Cropkeeper application mark consistent across site assets.

## 9. Automated regression coverage

SEO coverage verifies the important observable contracts, including:

- public indexable pages;
- absolute self-canonicals;
- query parameters excluded from canonical URLs;
- active pages `index, follow`;
- legal archives `noindex, follow`;
- sitemap XML content and exclusions;
- robots sitemap reference;
- social metadata;
- landing JSON-LD;
- absence of unsupported structured pricing/ratings;
- favicon links/assets;
- homepage title/description/keywords;
- hero image alt/loading attributes;
- `/privacy` 301 redirect.

Normal project verification remains:

```bash
vendor/bin/pint --dirty --format agent
composer test
npm run build
```

## 10. Production acceptance — completed

Production acceptance for the current landing baseline is closed.

Confirmed as complete for this checkpoint:

- production site published at `https://cropkeeper.me`;
- canonical/indexation/sitemap/robots behavior accepted;
- Yandex Webmaster configured;
- Yandex Metrika configured with the site's consent/privacy model;
- production tariff/checkout reconciliation completed;
- landing security/privacy acceptance completed;
- open-source dependency/license acceptance completed;
- production PageSpeed/Lighthouse run reviewed;
- no release-blocking SEO, performance or best-practices issue found.

Google Analytics is intentionally not used. Google Search Console is separate from Analytics and remains optional monitoring/diagnostic tooling rather than a release requirement for this project.

## 11. PageSpeed / Lighthouse accepted baseline

Production report date: **2026-09-16**.

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

The accepted baseline satisfies the release targets for LCP and CLS. Desktop CLS is very close to `0.1`; future layout/image changes should be checked for regression.

PageSpeed showed **No Data** for real-user / CrUX field data at the time of the report. Lack of field data is not a blocker. Revisit field Core Web Vitals later when enough production traffic exists.

### Non-blocking findings retained for future optimization

- render-blocking requests: estimated savings about **300 ms mobile** and **80 ms desktop**;
- improve image delivery: estimated savings about **6 KiB mobile** and **14 KiB desktop**;
- image elements do not have explicit `width` and `height`;
- background/foreground contrast issue, resulting in Accessibility **96**;
- mobile Speed Index **3.9 s** despite strong LCP **1.2 s**.

These findings are optimization opportunities, not reasons to reopen the release gate by themselves.

## 12. Search-engine tooling policy

Yandex is the actively configured search/analytics stack for this release:

- Yandex Webmaster is configured;
- Yandex Metrika is configured;
- sitemap is exposed through `robots.txt` and the production site.

Google Analytics must not be treated as an SEO requirement and is intentionally omitted.

Google Search Console can be connected later if Google-specific indexing, query or recrawl diagnostics become useful. It is operationally useful but not required for the accepted current landing baseline.

## 13. Deferred SEO maintenance

Not required for the current release gate:

- dedicated 1200×630 social card;
- `Organization` JSON-LD where justified;
- paid `Offer` structured data where useful and synchronized;
- explicit hero image dimensions after reliable measurement;
- fixing the Lighthouse contrast issue;
- further reduction of render-blocking resources;
- further image-delivery optimization;
- additional SEO/content landing pages based on real demand;
- international SEO/hreflang;
- ongoing query-based homepage refinements from Yandex Webmaster and optional Google Search Console;
- monitoring CrUX/Core Web Vitals once field data becomes available.

Do not add an artificial keyword-heavy SEO text block. Existing feature and roadmap content already provides natural topical depth.

## 14. New-chat restart checklist

If SEO maintenance is revisited, read:

1. `AGENTS.md`;
2. `docs/PROJECT_STATUS.md`;
3. `docs/SEO_PLAN.md`;
4. `docs/ROADMAP.md`;
5. `resources/views/layouts/site.blade.php`;
6. `resources/views/landing.blade.php`;
7. `routes/web.php`;
8. `public/robots.txt`;
9. SEO-related feature tests.

The implementation and production acceptance are complete. Do not reimplement the SEO foundation unless a regression, material product change or new requirement is identified.
