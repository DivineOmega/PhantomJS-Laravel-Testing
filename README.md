# PhantomJS Laravel Testing

## Features

* Identical syntax to standard Laravel testing code where possible
* PhantomJS-powered headless browser allows full functionality testing, including JavaScript & AJAX
* Makes use of database transactions to prevent testing having permanent effects on the database
* Automated setup and install of all dependencies, including phantomjs binary

## Requirements

*  Only Laravel 5.1 is currently supported

## Installation

1. Add composer script `"PhantomInstaller\\Installer::installPhantomJS"` to `composer.json` `post-install-cmd` and `post-update-cmd` arrays.
2. Install via `composer require divineomega/phantomjs-laravel-testing`.
3. Add service provider `DivineOmega\PhantomJSLaravelTesting\ServiceProvider::class` to `config/app.php` `providers` array.
4. Add global middleware `\DivineOmega\PhantomJSLaravelTesting\Http\Middleware\GlobalMiddleware::class` to `app/Http/Kernel.php` `middleware` array.

