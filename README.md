# PhantomJS Laravel Testing

The PhantomJS Laravel Testing package allows you to easily test your Laravel application's JavaScript functionality.
It makes use of the PhantomJS headless browser to emulate how a real use would interact with your pages. If 
you have done regular Laravel testing, you'll be happy to know that this package attempts to match its syntax 
as much as possible.

**💡 NOTE: If you're starting a new project, I recommend using [Laravel Dusk](https://laravel.com/docs/master/dusk) instead.  [PhantomJS development is being suspended](https://github.com/ariya/phantomjs/issues/15344) and will likely not receive any future updates.**

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

## Usage

Simply change your test classes to extend `PhantomJSTestCase` instead of `TestCase`, then run your unit tests as you normally do. PhantomJS will
automatically be started up when required.

An example test case is shown below.

```php

<?php

use DivineOmega\PhantomJSLaravelTesting\Objects\PhantomJSTestCase;

class ExampleTestCase extends PhantomJSTestCase
{
    public function testGoogleShowsImFeelingLucky()
    {
    
        $this->visit('https://google.co.uk/');
        $this->see('I\'m Feeling Lucky');
    }

    public function testGoogleShowsImFeelingDucky()
    {
        $this->visit('https://google.co.uk/');
        $this->see('I\'m Feeling Ducky');
    }
}

```
