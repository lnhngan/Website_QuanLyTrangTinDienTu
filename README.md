# Sport News - Laravel 11 Demo Skeleton

This zip contains a small demo skeleton for a sports news website (frontend + admin CRUD skeleton)
meant for a student graduation project. It's tailored for Laravel 11.

## How to use

1. Copy the files into your Laravel project.
   - Place `app/Http/Controllers/*` into `app/Http/Controllers/`
   - Place `app/Models/*` into `app/Models/`
   - Place the Blade views into `resources/views/`
   - Replace `routes/web.php` or merge routes.

2. Import the provided `sport_news.sql` (if you have it) or create DB and run migrations.

3. Ensure composer dependencies and run:
   ```
   composer install
   php artisan key:generate
   php artisan migrate
   php artisan serve
   ```

4. For demo admin login, create a user in `users` table with role 'admin'.

## Notes
- This is a lightweight skeleton to help you get started quickly for the project.
- You should add authentication middleware, form validation, file uploads, and polish UI for final submission.
