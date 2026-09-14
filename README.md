# Cropkeeper Site

Public landing for `cropkeeper.me`. The site explains Cropkeeper, publishes tariffs and legal documents, and provides the public information required for production payment-provider onboarding.

## Current status

The first landing implementation, canonical legal-document architecture, and final Offer / Personal Data Processing Policy revision have been completed and merged into `dev`.

The active release stage is now **consent-gated Yandex Metrika before production payment-provider onboarding**. Remaining work after analytics consent includes final tariff/subscription copy, cross-repository legal-link/product-behavior synchronization, and release security/license checks.

See:

- `docs/PROJECT_STATUS.md` — current checkpoint and release blockers;
- `docs/ROADMAP.md` — ordered remaining release stages;
- `docs/LEGAL_AUDIT_PLAN.md` — detailed implementation plan and acceptance criteria.

## Branching

The repository follows gitflow.

- feature/documentation work branches from the current `dev`;
- changes are reviewed/verified before integration into `dev`;
- `main` is reserved for production-ready promotion;
- do not commit feature work directly to `dev` or `main`.

## Stack

- Laravel 13
- Blade
- Tailwind CSS 4 / custom CSS
- Vite
- Lucide (`lucide` npm package; no icon CDN)

## Local setup

```bash
composer install
cp .env.example .env
php artisan key:generate
npm install
npm run build
composer test
```

For development:

```bash
composer dev
```

## Canonical public legal pages

- `/agreement` — User Agreement
- `/offer` — Public Offer / paid-access terms
- `/personal-data` — Personal Data Processing Policy
- `/cookies` — cookies and Yandex Metrika information
- `/privacy` — permanent legacy redirect to `/personal-data`

Archive routes use:

```text
/legal/{document}/archive
/legal/{document}/archive/{revision}
```

Document metadata and current/archive revision mappings live in `config/legal.php`. Published archived revisions are repository-backed and must not be edited retroactively.

## Landing configuration

Public content that must be easy to change without editing templates lives in `config/landing.php`.

Production-specific values are supplied through `.env`:

```dotenv
CROPKEEPER_APP_URL=https://app.cropkeeper.me

YANDEX_METRIKA_COUNTER_ID=

LANDING_SELLER_NAME="..."
LANDING_SELLER_STATUS="..."
LANDING_SELLER_INN="..."
LANDING_SELLER_OGRN="..."
LANDING_SELLER_ADDRESS="..."
LANDING_CONTACT_EMAIL="..."
LANDING_CONTACT_PHONE="..."

LANDING_PRO_MONTHLY_PRICE="... ₽"
LANDING_PRO_YEARLY_PRICE="... ₽"
LANDING_PREMIUM_MONTHLY_PRICE="... ₽"
LANDING_PREMIUM_YEARLY_PRICE="... ₽"
```

Seller/contact fields are rendered only when the corresponding configured value is present.

The tariff matrix is currently static in the site config. This keeps the public landing available independently of the application API. Before production onboarding, displayed paid prices and commercial wording must be reconciled with the actual application checkout.

## Yandex Metrika consent

Metrika is configured through `YANDEX_METRIKA_COUNTER_ID`. If the value is empty, the analytics consent UI and Metrika integration are not rendered.

When a counter ID is configured:

- the initial server-rendered HTML contains no Yandex Metrika script or `noscript` tracking pixel;
- the visitor must explicitly choose whether analytics is allowed;
- accept/reject state is stored in localStorage together with the consent-policy version;
- rejection prevents Metrika initialization on later page loads;
- the footer exposes `Настройки аналитики`, allowing the visitor to change the choice later;
- withdrawing consent calls the Metrika `destruct` method, removes the dynamically injected script, and clears known first-party Metrika cookies where possible;
- Webvisor is disabled by default;
- automatic initial pageview sending is disabled and the site sends a pageview URL without query parameters after consent.

Analytics settings live in `config/analytics.php`. Before enabling a production counter, verify the actual Yandex-side counter settings as part of privacy acceptance.

## Legal-source architecture

`cropkeeper.me` is the single public source of current legal documents used by both the landing and `asboldyrev/cropkeeper-app`.

Rules:

- stable canonical active-document URLs;
- public access without authentication;
- explicit revision/version metadata;
- public archive index for every legal document;
- immutable archived revisions;
- application links point to the same canonical site URLs;
- Personal Data Processing Policy is not treated as a contract requiring acceptance;
- explicit consent is requested only where consent is actually the legal basis;
- Yandex Metrika loads only after explicit analytics consent.

See `docs/LEGAL_AUDIT_PLAN.md` for the full target design.

## Production onboarding gate

Before submitting `cropkeeper.me` for merchant review and before promoting `dev` to `main`, confirm all of the following:

- final current legal documents are published at canonical public URLs;
- every superseded legal revision is preserved in the public immutable archive;
- CloudTips and obsolete support/payment wording are absent from active content;
- Yandex Metrika is consent-gated, documented, and production settings have been verified;
- paid-access wording distinguishes access without auto-renewal from auto-renewing subscriptions;
- public tariff prices match the actual application checkout;
- refund and auto-renewal rules match application behavior;
- application legal links use the same canonical site URLs;
- production seller/contact values are filled;
- security acceptance passes;
- open-source license acceptance passes;
- the production URL is public and all legal/archive/consent flows pass smoke testing.
