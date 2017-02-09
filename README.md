# PhantomJS Laravel Testing

## Features

* Identical syntax to standard Laravel testing code where possible
* PhantomJS-powered headless browser allows full functionality testing, including JavaScript & AJAX
* Makes use of database transactions to prevent testing having permanent effects on the database
* Automated setup and install of all dependencies, including phantomjs binary

## Requirements

*  Only Laravel 5.1 is currently supported

## Installation

1. Install via `composer require divineomega/phantomjs-laravel-testing`.
2. Add service provider.
3. Add global middleware.
