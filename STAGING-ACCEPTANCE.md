# Staging acceptance — MUST PASS before live cutover

1. Confirm all original pages and images exactly match the current static site (desktop and mobile).
2. Check 8 existing location .html URLs return 200, no redirect chains, canonical URLs and content preserved.
3. Check 8 dynamic /lp/mobile-tyre-fitting-{city} pages return 200 and show city-specific copy; paused pages return 404.
4. Check GTM in Tag Assistant on the new /lp pages. Existing legacy HTML may have older Google Ads gtag; audit tags to avoid double counting and premature firing.
5. Test consent: reject optional -> no marketing/analytics storage; accept -> consent update; reopen -> preferences persist.
6. Verify all 4 call-out fee options with the client; Today currently defaults to £95 and must be confirmed.
7. Test WhatsApp quote on iPhone Safari, Android Chrome, desktop; ensure message includes fee, postcode, appointment and campaign city.
8. Confirm actual Google Ads final URLs and GCLID/UTM survival; Google Ads clicks must continue resolving during cutover.
9. Test admin login/logout, CSRF, throttle, edit/save, create, active toggle and indexability toggle.
10. Run migrations/seed on staging DB; run `php artisan route:list`, `php artisan optimize`, check logs and PHP error reporting.
11. Confirm public document root is project/public, PHP 8.2+, SSL, backups, storage permissions, correct APP_URL and APP_DEBUG=false.
12. Verify sitemap.xml and robots.txt live; submit sitemap in Google Search Console only after successful cutover.
13. Audit SEO metadata and structured data; do not imply fake branches or addresses.
14. Confirm cookies/analytics policy with privacy owner; Google Consent Mode is implemented on new /lp pages, but legacy pages need a separate consent audit.

Do not replace production until every check passes.
