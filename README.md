# Cropkeeper Site

Public landing for `cropkeeper.me`. The site explains Cropkeeper, publishes tariffs and legal documents, and provides the public information required for production payment-provider onboarding.

## Branching

The repository follows gitflow. Feature work branches from `dev`; do not commit feature changes directly to `dev`.

Current landing work: `feature/payment-provider-landing`.

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

## Public pages

- `/` — landing, current product capabilities, tariffs, roadmap, contacts and seller details
- `/offer` — public offer
- `/privacy` — privacy policy
- `/personal-data` — personal data processing policy

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

The tariff matrix itself is intentionally static in the site config for the first release. This keeps the public landing available even if the application API is unavailable and makes merchant onboarding independent from application authentication/CORS. If a public read-only tariff endpoint is introduced later, the source can be replaced without redesigning the page.

## Payment-provider onboarding gate

Before submitting `cropkeeper.me` for review, confirm all of the following:

- the production URL opens publicly without authentication;
- all placeholder seller/contact values have been replaced;
- paid tariff prices are real and match the application checkout;
- the product description reflects only functionality actually offered;
- `/offer`, `/privacy`, and `/personal-data` open publicly;
- the offer describes access timing, automatic renewal, cancellation and refunds;
- seller legal details and contacts are visible in the footer;
- all purchase-related pages remain on the intended public domain or are clearly linked to the application checkout;
- there are no development/test labels, sample seller data or fake prices in production.

The legal pages are working launch templates, not a substitute for a final legal review. They must be checked against the actual seller status, infrastructure, payment provider and production data flows before publication.
