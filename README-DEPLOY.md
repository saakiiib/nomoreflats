# No More Flats — Laravel conversion and dynamic landing pages

## Source preservation
- Converted from the uploaded `_public_html-2.zip`. The existing HTML pages are preserved as `resources/views/legacy/*.html` and served at their original URLs.
- Existing CSS, images, JS and other public assets are copied into `public/`.
- **Do not point the web root to the Laravel project root.** Set document root to `PROJECT/public`.
- This is a Laravel-ready source package, **not a preinstalled vendor build**. Requires Composer and PHP 8.2+ and MySQL.

## Sakib deployment
1. Back up the live `public_html` and database. Deploy to a staging domain first.
2. Install Composer dependencies: `composer install --no-dev --optimize-autoloader`.
3. Copy `.env.example` to `.env`; configure `APP_URL`, MySQL, mail if needed.
4. Run `php artisan key:generate`.
5. Generate an admin password hash using `php -r 'echo password_hash("YOUR_LONG_PASSWORD", PASSWORD_BCRYPT), PHP_EOL;'` and put it in `ADMIN_PASSWORD_HASH` in `.env`. Set `ADMIN_EMAIL`. Do not commit secrets.
6. Run `php artisan migrate --force` then `php artisan db:seed --force`.
7. Set write access on `storage/` and `bootstrap/cache/`; `php artisan config:cache && php artisan route:cache && php artisan view:cache`.
8. Visit `/admin/login` and manage pages at `/admin/landing-pages`.
9. Check the old URLs, mobile layout, forms, cookie consent, GTM and robots/sitemap on staging before DNS change.

## URLs
- Original SEO pages retain their `.html` URLs.
- Dynamic campaign pages use `/lp/mobile-tyre-fitting-sheffield`, etc.
- `indexable` defaults OFF for paid-ad landing pages. Turn on only after adding useful distinct local content and reviewing canonical strategy.
- `sitemap.xml` is generated dynamically for legacy pages plus indexable active landing pages.

## Important outstanding production checks
- Legacy site JS and Google Tag Manager are preserved from the source ZIP; verify consent mode and prevent analytics/advertising tags firing before optional consent.
- Dynamic landing pages now include a full responsive enquiry/booking modal, call-out pricing, tyre guide, Google Tag Manager and a consent preferences panel. These additions require browser and server verification before launching paid campaigns.
- Admin uses session auth and rate limiting; recommend moving to Laravel Breeze/Fortify with proper users, password reset and optional 2FA before broader staff access.
- Verify fee values with client before displaying any on landing pages.
- Check business opening hours and area coverage claims with the client. No fictional branches or fake local addresses.
- Existing SEO page titles and canonical URLs should be audited; raw HTML is intentionally preserved rather than rewritten.

## New dynamic landing features (November 2026)
- Eight city landing pages with area-specific headlines, responsive design, van imagery and mobile CTA.
- WhatsApp quote modal: service, urgency, price, tyre size, quantity, postcode, vehicle, notes.
- Default call-out fees: ASAP £95, Today £95 (assumption, **confirm**), Tomorrow £71, Choose a Date £35. These are call-out fees only; configure via `NMF_FEE_*` environment variables.
- GTM ID configurable via `NMF_GTM_ID`. Consent Mode v2 defaults to denied for new landing pages.
- Admin password hash and email are read from Laravel config, compatible with `config:cache`.
- **Existing legacy pages were intentionally preserved**, including any existing Google Ads scripts; their consent handling and double-counting need review in staging.
- This package cannot be called production-verified until Composer dependencies are installed and the acceptance checklist passes.
- See `STAGING-ACCEPTANCE.md` for mandatory launch checks.
