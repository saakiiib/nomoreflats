# No More Flats V3 — deployment / upgrade instructions

## Upgrade from deployed V2
1. **Back up** live site files, `.env` and database. Keep the current Google Ads final URLs unchanged until staging checks pass.
2. Upload V3 application files to staging first, **preserving the existing production `.env`**. Do not overwrite the live `.env` or production database.
3. Run `composer install --no-dev --optimize-autoloader`, `php artisan migrate --force`, `php artisan optimize:clear`, `php artisan config:cache`, `php artisan view:cache` (from project root). Laravel public directory must remain the web root.
4. Test existing homepage, all `.html` URLs, all eight `/lp/` URLs, admin login, existing GTM conversions and cookie consent.
5. Test `/admin/content`, create a **draft** page (`type=page`, slug `tyres-for-sale`) and a **draft** blog post; publish only when copy is approved. Public URLs are `/pages/tyres-for-sale` and `/blog/{slug}`. Blog index is `/blog`.
6. Verify footer area links, call/WhatsApp click tracking, mobile rendering, canonical and noindex settings. Check Laravel logs and server error logs.
7. Release at a quiet time, run migrations once, warm caches and monitor Google Ads and forms. Roll back files if required; avoid reverting migrations while V3 content exists.

## V3 additions
- Polished landing-page admin with overview cards.
- Service-area footer on `/lp/` pages and removal of awkward branch disclaimer.
- New Pages & Blog management in the same existing admin session.
- Draft/publish and index/noindex toggles; SEO title and description; public blog index and post pages.
- Tyre sales **information page** can be authored from admin. This is NOT a tyre catalogue, inventory, checkout or payment integration.
- Sitemap automatically includes published indexable content pages and blog posts.

## Important limitations / review items
- No complete runtime end-to-end test on your production server was performed. PHP syntax and ZIP integrity checks are not substitutes for staging testing.
- Content editor uses safe escaped plain text, not a WYSIWYG image uploader. Blog and pages are basic publishing, not a full ecommerce system.
- Legacy HTML remains served unchanged. Legacy cookie consent/GTM needs a separate consent compliance audit. The new V3 content pages inherit consent state from `nmf_cookie_consent_v2`; verify this matches the live site's cookie storage structure.
- V3 content pages and blog are not automatically added to legacy homepage navigation; link from your site where desired.
- Landing-page fees still come from `.env` and should be verified with the client.
