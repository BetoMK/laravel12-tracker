# Laravel 12 Stats Tracker (tracking only)

Public fork of [deivide/laravel-tracker](https://github.com/deivide/laravel-tracker) (originally [pragmarx/tracker](https://github.com/antonioribeiro/tracker)), adapted for **Laravel 10 / 11 / 12**.

This package records visitor/session data. The **SB Admin stats panel and Datatables dependency were removed**.

Namespace remains `PragmaRX\Tracker` for drop-in compatibility.

## Requirements

- PHP `^8.2`
- Laravel `^10|^11|^12`
- Optional: `geoip/geoip` or `geoip2/geoip2` for GeoIP

## Install

```bash
composer require betomk/laravel12-tracker
php artisan vendor:publish --provider="PragmaRX\Tracker\Vendor\Laravel\ServiceProvider"
```

`betomk/laravel12-support` is pulled in automatically from Packagist.

Configure a `tracker` database connection if you use a separate DB, then:

```bash
php artisan tracker:tables
php artisan migrate
```

Enable tracking in `config/tracker.php`:

```php
'enabled' => true,
'log_enabled' => true,
'use_middleware' => true,
```

Register the middleware (Laravel 11/12 `bootstrap/app.php`):

```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->web(append: [
        \PragmaRX\Tracker\Vendor\Laravel\Middlewares\Tracker::class,
    ]);
})
```

Or in legacy `app/Http/Kernel.php`, append the same class to the `web` middleware group.

## What is tracked

Enable individual features in `config/tracker.php` (`log_users`, `log_geoip`, `log_sql_queries`, etc.). By default most options are off; start with `log_enabled`.

Facade:

```php
$visitor = Tracker::currentSession();
```

## Not included

- Stats panel UI / SB Admin templates
- `pragmarx/datatables` / Bllim Datatables

## License

MIT (see `LICENSE`).
