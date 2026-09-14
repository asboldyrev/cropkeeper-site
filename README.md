# Cropkeeper Site

Public landing for `cropkeeper.me`. The site explains Cropkeeper, publishes tariffs and legal documents, and provides the public information required for production payment-provider onboarding.

## Current status

The first landing implementation has been completed and merged into `dev`.

The active release stage is now **legal hardening before production payment-provider onboarding**. Final legal-audit requirements include canonical versioned legal documents, public immutable archives, Yandex Metrika consent, final tariff/subscription wording, cross-repository application/legal synchronization, and release security/license checks.

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

The former `feature/payment-provider-landing` branch was merged into `dev` on 2026-09-09 and removed. It is no longer the current working branch.

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

## Current public pages

- `/` — landing, current product capabilities, tariffs, public roadmap, contacts and seller details
- `/offer` — current first-pass public Offer
- `/privacy` — current first-pass Privacy Policy
- `/personal-data` — current first-pass Personal Data Processing Policy

These legal pages are **not yet the final audited document architecture**. The final legal-hardening stage must add the User Agreement, cookies/Yandex Metrika documentation, document revision/version metadata and public immutable archives, and must revise the existing legal texts to match the final Cropkeeper behavior.

## Landing configuration

Public content that must be easy to change without editing templates lives in `config/landing.php`.

Production-specific values are supplied through `.env`:

```dotenv
CROPKEEPER_APP_URL=https://app.cropkeeper.me

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

## Legal-source architecture target

`cropkeeper.me` must become the single public source of current legal documents used by both the landing and `asboldyrev/cropkeeper-app`.

Target rules:

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
- every legal document has revision metadata and a public immutable archive;
- CloudTips and obsolete support/payment wording are absent from active content;
- Yandex Metrika is consent-gated and documented;
- paid-access wording distinguishes access without auto-renewal from auto-renewing subscriptions;
- public tariff prices match the actual application checkout;
- refund and auto-renewal rules match application behavior;
- application legal links use the same canonical site URLs;
- production seller/contact values are filled;
- security acceptance passes;
- open-source license acceptance passes;
- the production URL is public and all legal/archive/consent flows pass smoke testing.
