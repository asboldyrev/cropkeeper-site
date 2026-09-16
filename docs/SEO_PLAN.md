# Cropkeeper Site SEO plan

Last updated: 2026-09-16

This document is the canonical handoff source for SEO work in `asboldyrev/cropkeeper-site`. The implementation phase is complete in `dev`; the remaining SEO work is production acceptance and post-launch monitoring.

Do not promote `dev` to `main` merely because the SEO implementation is complete. Legal, commercial, privacy/security, license, application-integration, seller-data and merchant-onboarding gates still apply.

## 1. Current SEO state

The current `dev` line now includes:

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
- meaningful hero screenshot alt text and high fetch priority;
- SEO regression tests covering canonical/indexation, sitemap/robots, social metadata, structured data, favicon assets, homepage metadata and hero image behavior.

The site remains Russian-only. International SEO is intentionally out of scope until a real second-language version exists.

## 2. Indexation and canonical policy

### Indexable

The following pages are intended to be indexed and use self-referencing absolute canonical URLs:

- `/`;
- `/agreement`;
- `/offer`;
- `/personal-data`;
- `/cookies`.

Canonical base host is controlled through `APP_URL`; production must therefore use the production HTTPS origin.

### Redirect

`/privacy` permanently redirects to `/personal-data` and is excluded from the sitemap.

### Legal archives

Legal archive indexes and revisions remain public for transparency but are not search landing pages:

- `/legal/{document}/archive` → `noindex, follow`;
- `/legal/{document}/archive/{revision}` → `noindex, follow`;
- archive URLs are excluded from the sitemap.

Do not make archive pages private merely to keep them out of search.

## 3. Sitemap and robots

`/sitemap.xml` is application-owned and currently contains only:

- `/`;
- `/agreement`;
- `/offer`;
- `/personal-data`;
- `/cookies`.

It intentionally omits redirects and legal archives.

`robots.txt` is static in `public/` because the production nginx configuration serves `robots.txt` as a static asset instead of passing it to Laravel. It currently allows crawling and references the production sitemap URL.

If the production host changes, update both `APP_URL` and the static sitemap reference in `public/robots.txt` so they remain consistent.

## 4. Shared metadata architecture

`resources/views/layouts/site.blade.php` now centralizes:

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

The current homepage target was selected after reviewing live search-result intent.

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

Important intent exclusions:

- do not make `планировщик огорода` the primary topic while the product does not yet provide garden-bed/site planning;
- do not make `календарь огородника` the primary topic while users commonly expect ready-made planting/lunar recommendations rather than a personal event/task calendar.

The current H1 and hero copy were intentionally kept natural instead of forcing an exact-match keyword into visible copy.

Exact Yandex Wordstat volume was not available publicly during research; no search-volume numbers were invented. Refine targeting later from Search Console / Yandex Webmaster query data.

## 6. Structured data

The landing emits JSON-LD for:

- `WebSite`;
- `SoftwareApplication`.

Supported fields include Cropkeeper name, canonical URL, page description, Russian language, web operating system and application category.

Currently excluded intentionally:

- `Organization` unless public seller/brand facts justify it;
- paid `Offer` data until production checkout values are frozen and exactly reconciled;
- ratings, reviews, awards, install counts or other unsupported claims.

After production deployment, validate the rendered page with structured-data validators. Do not assume source-code inspection alone proves crawler-visible validity.

## 7. Images and social preview

`public/images/app.png` currently serves two roles:

- landing hero screenshot;
- initial Open Graph / Twitter social image.

Hero image behavior:

- meaningful alt: `Интерфейс Cropkeeper с данными огородного сезона`;
- `fetchpriority="high"` because the hero image may participate in LCP;
- `decoding="async"`.

A dedicated 1200×630 branded social card remains optional future work, not a release blocker.

The PNG dimensions were not hard-coded because they were not reliably confirmed during repository-only work. If future performance work confirms dimensions, adding explicit `width`/`height` is reasonable to reduce layout uncertainty.

## 8. Favicons

The previous empty `public/favicon.ico` has been replaced. Current public assets include:

- `favicon.svg`;
- `favicon.ico`;
- `favicon-32x32.png`;
- `apple-touch-icon.png`.

The shared layout references all of them. Do not replace the Cropkeeper mark with an unrelated site-specific logo.

## 9. Automated regression coverage

SEO coverage is distributed across feature tests and currently verifies the important observable contracts, including:

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

## 10. Production SEO acceptance — still pending

This is now the first incomplete SEO checkpoint.

After deploying an SEO-complete candidate to the production origin, verify all of the following:

1. `APP_URL` resolves to the final HTTPS production origin and rendered canonicals use it.
2. `/`, `/agreement`, `/offer`, `/personal-data`, `/cookies` return 200 and are indexable.
3. `/privacy` returns a permanent redirect to `/personal-data`.
4. representative legal archive pages remain accessible and render `noindex, follow`.
5. `/sitemap.xml` returns 200, valid XML and only intended canonical URLs.
6. `/robots.txt` returns 200 and references the correct production sitemap.
7. submit the sitemap in Google Search Console and monitor the Sitemaps/Page Indexing reports.
8. inspect the homepage and active legal pages with Google URL Inspection; request indexing where appropriate.
9. add/verify the site in Yandex Webmaster and submit the sitemap there; run Yandex's Sitemap validator.
10. validate rendered JSON-LD using Google Rich Results Test and an additional schema validator.
11. verify Open Graph/social preview behavior and favicon visibility from the public origin.
12. run PageSpeed Insights on mobile and desktop.
13. confirm no shared-layout SEO change caused analytics/privacy regressions: Yandex Metrika must still remain blocked until explicit consent.

Core Web Vitals targets for production acceptance:

- LCP < 2.5 s;
- INP < 200 ms;
- CLS < 0.1.

Repository inspection alone cannot close these items; production/runtime evidence is required.

## 11. Search-engine onboarding notes

For Google, submit the already-hosted sitemap through Search Console's Sitemaps report. URL Inspection is the correct tool for checking individual pages and requesting recrawl/indexing after deployment. Sitemap submission helps Google discover multiple URLs but does not guarantee indexing.

For Yandex, the sitemap may be advertised through the `Sitemap` directive in `robots.txt` and should also be added in Yandex Webmaster for monitoring. Use the Yandex Sitemap validator against the public URL after deployment.

Do not mark these tasks complete merely because the files exist in the repository.

## 12. Deferred SEO work

Not required for the current release gate:

- dedicated 1200×630 social card;
- adding `Organization` JSON-LD once public seller/brand data justify it;
- paid `Offer` structured data after checkout values are finalized;
- explicit hero image dimensions after reliable asset measurement;
- additional content/SEO landing pages based on real demand;
- international SEO/hreflang;
- ongoing query-based homepage refinements from Search Console/Yandex Webmaster.

Do not add an artificial keyword-heavy SEO text block. The existing feature and roadmap content already provides natural topical depth.

## 13. New-chat restart checklist

When continuing SEO work in a new chat, read:

1. `AGENTS.md`;
2. `docs/PROJECT_STATUS.md`;
3. `docs/SEO_PLAN.md`;
4. `docs/ROADMAP.md`;
5. `resources/views/layouts/site.blade.php`;
6. `resources/views/landing.blade.php`;
7. `routes/web.php`;
8. `public/robots.txt`;
9. SEO-related feature tests.

Then continue from section 10 of this document. The technical implementation is complete; do not reimplement it unless a regression or changed requirement is identified.
