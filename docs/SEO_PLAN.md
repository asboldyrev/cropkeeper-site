# Cropkeeper Site SEO plan

Last updated: 2026-09-16

This document is the handoff source for SEO work in `asboldyrev/cropkeeper-site`. It records the audit conclusions, agreed implementation decisions, order of work, and acceptance criteria so the work can be resumed from a new chat without reconstructing context from conversation history.

The implementation target is the current `dev` line. SEO changes must be developed in a feature branch and reviewed before integration into `dev`. Do not promote `dev` to `main` merely because the SEO work is complete; the existing legal, commercial, security, privacy, license, and production-onboarding gates still apply.

## 1. Current SEO baseline

The site is a server-rendered Laravel/Blade public landing with the following relevant properties already present:

- `/` is the public landing page;
- canonical public legal pages exist at `/agreement`, `/offer`, `/personal-data`, `/cookies`;
- `/privacy` permanently redirects to `/personal-data`;
- immutable public legal archive routes exist under `/legal/{document}/archive` and `/legal/{document}/archive/{revision}`;
- `<html lang="ru">` is present;
- viewport, page title, and meta description are present;
- the landing has one primary H1 and a logical H2/H3 structure;
- the main content is rendered server-side and does not depend on client-side JavaScript for discovery;
- navigation and legal links are ordinary HTML links;
- trailing slashes for non-directory URLs are normalized with a permanent redirect;
- `robots.txt` currently allows crawling but does not reference a sitemap;
- there is currently no `sitemap.xml`;
- there is currently no `rel="canonical"` output;
- Open Graph/Twitter metadata are not implemented;
- structured data / JSON-LD are not implemented;
- the current `public/favicon.ico` is empty;
- the hero application screenshot is `public/images/app.png` and is currently rendered with an empty `alt`;
- no international/multilingual URL structure exists; the site is Russian-only for now.

## 2. Search goals and scope

The immediate goal is to make the existing landing technically correct and clear for Google and Yandex before expanding into additional SEO/content pages.

Work order follows this priority:

1. crawlability and indexation;
2. canonical URL signals and sitemap;
3. search/social metadata and favicon;
4. structured data;
5. keyword research and targeted on-page adjustments;
6. automated regression coverage;
7. production validation in search-engine tools and performance tooling.

Do not create a blog, programmatic SEO pages, or large blocks of text written only for search engines as part of this phase.

## 3. Indexation and canonical policy

### 3.1 Indexable pages

The following active pages should be indexable and should use self-referencing canonical URLs:

- `/`;
- `/agreement`;
- `/offer`;
- `/personal-data`;
- `/cookies`.

Canonical URLs must be absolute production URLs using the production scheme and host.

### 3.2 Redirect URL

`/privacy` remains a permanent redirect to `/personal-data` and must not appear in the sitemap.

### 3.3 Legal archives

Legal archives must remain publicly accessible for legal transparency, but they are not intended as search landing pages.

Target policy:

- `/legal/{document}/archive`: `noindex, follow`;
- `/legal/{document}/archive/{revision}`: `noindex, follow`;
- archive URLs must not appear in the sitemap;
- archived content must remain accessible without authentication;
- the active canonical legal documents remain indexable.

This avoids building a growing index of near-duplicate historical legal revisions while preserving public access and link traversal.

## 4. Sitemap and robots.txt

Add an application-owned `/sitemap.xml` instead of maintaining a hand-written static list.

The sitemap should contain only canonical, indexable public URLs from section 3.1. It should not contain redirects, legal archive pages, or non-canonical variants.

`public/robots.txt` should continue to allow crawling and add an absolute sitemap reference, conceptually:

```text
User-agent: *
Disallow:

Sitemap: https://cropkeeper.me/sitemap.xml
```

The actual production host should come from the application's canonical URL configuration rather than being duplicated inconsistently across templates where practical.

## 5. Shared SEO metadata architecture

Extend the shared site layout so pages can provide SEO values without duplicating raw head markup.

The layout should support, at minimum:

- page title;
- meta description;
- optional meta keywords;
- canonical URL;
- robots directive;
- Open Graph title;
- Open Graph description;
- Open Graph URL;
- Open Graph type;
- Open Graph image;
- Twitter card metadata;
- optional page-specific structured data.

Defaults should be safe, but indexation/canonical behavior must be explicit for special pages such as legal archives.

## 6. Meta keywords decision

`meta name="keywords"` is not used by Google for ranking, but Yandex still documents it as a possible relevance signal. Therefore Cropkeeper will support it as a small Yandex-specific supplemental signal, not as a primary SEO mechanism.

Rules:

- make `keywords` optional in the shared layout;
- use it primarily on the landing page where it has a clear semantic purpose;
- do not add long lists of synonyms or repeated phrases;
- do not use it as a substitute for clear visible copy, title, H1, and description;
- legal pages do not need keywords unless a concrete future reason appears.

Final landing keywords must be selected after keyword research. Preliminary semantic groups to investigate include:

- приложение для огородника;
- планировщик огорода;
- календарь огородника / календарь садовода;
- журнал / дневник огородника;
- учёт растений / посадок;
- учёт семян;
- планирование посадок.

These are research candidates, not the final approved keyword list.

## 7. Open Graph and social preview

Add Open Graph and Twitter metadata for indexable pages.

Required baseline:

- `og:site_name`;
- `og:type`;
- `og:title`;
- `og:description`;
- `og:url`;
- `og:image`;
- `twitter:card`.

For the first implementation, `public/images/app.png` may be used as the OG image so social previews have an image immediately.

This is an interim choice. A dedicated 1200x630 social card with Cropkeeper branding and interface context can be created later. Lack of a dedicated card is not a blocker for the current SEO phase.

## 8. Favicons and application logo assets

The current `public/favicon.ico` is an empty file and must be replaced.

The user has supplied Cropkeeper logo assets taken from the application (`logo.svg` and `logo.png`). During implementation, either use the supplied files directly if they are available in the working environment or prepare the expected public paths so the user can add the final files without changing markup.

Target favicon set:

- SVG favicon as the preferred modern icon;
- non-empty `favicon.ico` for compatibility;
- PNG favicon fallback(s) where useful;
- Apple Touch Icon;
- corresponding `<link>` tags in the shared layout.

Do not invent a different brand mark for the site.

## 9. Structured data

Add JSON-LD to the landing after the metadata/canonical foundation is in place.

Initial target entities:

- `WebSite`;
- `SoftwareApplication`;
- `Organization` only to the extent that public seller/brand details support it.

Rules:

- structured data must describe information that is actually visible/true on the site;
- do not invent ratings, reviews, awards, install counts, or other unsupported properties;
- paid `Offer` data should only be added when production checkout variants and prices are frozen and match the landing exactly;
- do not expose empty production-only seller/contact fields in JSON-LD;
- validate rendered JSON-LD with Google Rich Results Test / Schema Validator rather than assuming static source inspection is sufficient.

## 10. Landing content and keyword targeting

The updated roadmap block materially improves the landing's semantic coverage. It now exposes server-rendered, user-facing descriptions for currently available functionality including:

- plants and planting history;
- seed collection;
- care tasks;
- gardener calendar;
- observation journal;
- weather context.

The development roadmap also naturally mentions future concepts such as shared garden access, care recommendations, garden map, crop rotation, statistics, weather history, knowledge base, photo diary, smart assistant, and lunar calendar.

Because these are meaningful product descriptions rather than keyword filler, they provide useful topical depth. Therefore the current SEO phase must not add a separate artificial "SEO text" section merely to increase keyword density.

The visible roadmap introduction may be edited for natural Russian wording where useful, but this is a copy-quality refinement, not a requirement to increase keyword count.

### 10.1 Keyword research before final copy changes

Before finalizing the landing's main query target:

1. review Yandex Wordstat for candidate query groups;
2. inspect current Google and Yandex result pages for those queries;
3. determine whether the dominant search intent is software/app, informational article, planting calendar, or another format;
4. after production/search-console data exists, use Google Search Console and Yandex Webmaster query data to refine the decision;
5. map one primary topic and a small set of secondary topics to the homepage.

### 10.2 Targeted copy changes only

After research, adjust only what is needed:

- `<title>`;
- H1;
- meta description;
- first visible paragraph/hero copy;
- optional `keywords` metadata;
- selected H2/H3 wording if it materially improves clarity.

Do not rewrite the whole landing if current copy already communicates the product naturally.

## 11. Image SEO and accessibility

Review the hero screenshot:

```html
<img src=".../images/app.png" alt="">
```

If the image is treated as a meaningful demonstration of the Cropkeeper interface, give it a concise descriptive `alt`. If it is intentionally decorative and conveys no information beyond adjacent text, an empty `alt` is correct. Decide this explicitly rather than changing it only to satisfy an SEO checklist.

Continue to keep image assets reasonably compressed and avoid adding heavy social/branding images to the critical rendering path unnecessarily.

## 12. International SEO

International SEO is out of scope for the current phase.

The site currently has one Russian-language version, so do not add:

- hreflang;
- `x-default`;
- locale URL prefixes;
- multilingual sitemaps.

If another real language version is introduced later, revisit URL strategy, self-canonicals, reciprocal hreflang, `x-default`, and localized content as a separate project.

## 13. Core Web Vitals and performance

Repository inspection alone is insufficient to claim that production Core Web Vitals pass or fail.

Production acceptance should target:

- LCP below 2.5 seconds;
- INP below 200 ms;
- CLS below 0.1.

After deployment, test mobile and desktop with PageSpeed Insights and use field data from Search Console when enough traffic/data exists.

Pay particular attention to:

- hero/LCP asset loading;
- Vite JavaScript/CSS output;
- font loading;
- cache headers;
- server response time;
- unexpected layout shift.

## 14. Automated regression coverage

Add SEO-focused feature tests, either to `tests/Feature/PublicPagesTest.php` or a dedicated SEO feature test file.

Coverage should include at least:

- `/` returns 200;
- indexable pages contain exactly one title;
- indexable pages contain exactly one canonical link;
- canonical URL matches the expected canonical production URL logic;
- meta description exists;
- landing Open Graph metadata exists;
- landing JSON-LD exists once structured data is implemented;
- `/sitemap.xml` returns valid XML;
- sitemap contains only intended canonical/indexable URLs;
- `/privacy` is absent from sitemap;
- legal archive URLs are absent from sitemap;
- robots.txt references the sitemap;
- current legal documents are indexable;
- legal archive pages output `noindex, follow`;
- `/privacy` remains a permanent redirect to `/personal-data`;
- favicon assets referenced by the layout are non-empty/available where practical to test.

Run the normal project verification after implementation:

```bash
composer test
npm run build
```

## 15. Production acceptance

After deploying an SEO-complete candidate, verify:

- Google Search Console property and sitemap submission;
- Yandex Webmaster property and sitemap submission;
- URL inspection/indexability for the homepage and current legal pages;
- rendered canonical URLs;
- archive `noindex` behavior;
- Google Rich Results Test for structured data;
- Schema Validator as an additional JSON-LD validation step;
- social preview behavior with the initial OG image;
- favicon appearance/crawlability;
- PageSpeed Insights mobile and desktop;
- no accidental analytics/privacy regressions while changing the shared layout.

## 16. Implementation sequence

Implement in this order unless a concrete dependency requires otherwise:

1. shared SEO metadata architecture;
2. canonical and robots/indexation policy;
3. `/sitemap.xml` and robots.txt sitemap reference;
4. favicon/logo markup and assets;
5. Open Graph/Twitter metadata using `public/images/app.png` initially;
6. optional landing `meta keywords` support;
7. landing JSON-LD (`WebSite`, `SoftwareApplication`, supported organization data);
8. hero image alt/accessibility decision;
9. automated tests for all SEO invariants;
10. keyword research;
11. targeted title/H1/description/hero-copy refinements based on research;
12. production Google/Yandex/schema/PageSpeed acceptance.

## 17. Implementation constraints and handoff notes

- Start implementation from the current `dev` branch through a feature branch.
- `AGENTS.md` currently contains a Laravel Boost bootstrap instruction. Before application-code changes, follow that repository instruction in an environment where PHP/Composer and repository checkout are available, then reread the generated `AGENTS.md` before continuing.
- Do not change legal meaning while editing SEO metadata or page titles/descriptions.
- Do not make legal archive pages inaccessible merely because they are `noindex`.
- Do not introduce paid structured-data prices until checkout/landing prices are frozen and reconciled.
- Do not load Yandex Metrika before consent while changing `<head>` or shared layout behavior.
- Do not add international SEO until a genuine second-language version exists.
- Do not add extra keyword-heavy landing sections solely for ranking; the expanded roadmap already gives the page substantial natural topical coverage.

## 18. New-chat restart checklist

When continuing this work in a new chat, start by reading, in this order:

1. `AGENTS.md`;
2. `docs/PROJECT_STATUS.md`;
3. `docs/SEO_PLAN.md`;
4. `docs/ROADMAP.md`;
5. `resources/views/layouts/site.blade.php`;
6. `resources/views/landing.blade.php`;
7. `config/landing.php`;
8. `routes/web.php`;
9. `public/robots.txt`;
10. relevant feature tests.

Then compare the current branch with this plan and continue from the first incomplete item in section 16.
