# LuxeCurtain Hub Laravel Scaffold

This project has been ported from the Express/EJS starter to Laravel-style controllers, Blade views, and route definitions.

## Structure
- `routes/web.php` - Laravel routes
- `app/Http/Controllers` - page controllers
- `app/Models/Product.php` - in-memory product data
- `resources/views` - Blade templates
- `public` - shared CSS and JavaScript assets

## Run
1. Install PHP dependencies with Composer.
2. Serve the app with Laravel's built-in server.
3. Open the app in your browser.

If this folder is being turned into a full Laravel project, add the standard Laravel framework files and then run `composer install` followed by `php artisan serve`.

## Backend
- The contact form posts to `POST /consultation`.
- Requests are validated and stored in the `contact_inquiries` table.
- Successful submissions redirect back to the contact section with a flash message.
- Orders post to `POST /orders`, and admins can list them at `GET /api/admin/orders`.
- Public API endpoints exist for products, blog posts, success stories, site images, orders, and consultations under `GET/POST /api/...`.
- Admin API routes are protected with `X-Admin-Key` or `?admin_key=`. The scaffold default is `luxe-curtain-admin` unless `ADMIN_API_KEY` is set.
- Blog posts, success stories, products, consultations, and site images can all be managed through the admin API.

## Admin Panel
- Visit `/admin/login` and sign in with the admin key.
- The default scaffold key is `luxe-curtain-admin` unless `ADMIN_PANEL_KEY` is set.
- From the dashboard you can manage products, blog posts, success stories, site images, orders, and consultation requests.
- Product, blog post, story, and image forms support optional image uploads in addition to image URLs.
