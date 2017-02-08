<?php

namespace DivineOmega\PhantomJSLaravelTesting\Objects;

use PHPUnit_Framework_TestCase;
use Exception;
use Facebook\WebDriver\Remote\WebDriverCapabilityType;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverDimension;
use DivineOmega\PhantomJSLaravelTesting\Objects\LaravelTestCase;
use DivineOmega\PhantomJSLaravelTesting\Traits\CrawlerTrait;

abstract class PhantomJSTestCase extends PHPUnit_Framework_TestCase
{
    use CrawlerTrait;

    private $laravelTestCase;
    private $permittedLaravelTestCaseMethods = ['seeInDatabase'];

    private $driver;

    public function __construct()
    {
        $this->laravelTestCase = new LaravelTestCase();
        $this->setupDriver();
        parent::__construct();
    }

    public function __call($name, $arguments)
    {
        if (!in_array($name, $this->permittedLaravelTestCaseMethods)) {
            throw new Exception('Method not available: '.$name);
        }
        call_user_func_array([$this->laravelTestCase, $name], $arguments);
    }
    
    private function setupDriver()
    {
        $this->startPhantomJS();

        $host = '127.0.0.1:8910';
        $capabilities = array(
            WebDriverCapabilityType::BROWSER_NAME => 'phantomjs',
            'phantomjs.page.settings.userAgent' => 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:25.0) Gecko/20100101 Firefox/25.0',
        );

        $driver = RemoteWebDriver::create($host, $capabilities, 5000);

        $window = new WebDriverDimension(1024, 768);
        $driver->manage()->window()->setSize($window);

        $this->driver = $driver;
    }

    protected function driver()
    {
        return $this->driver;
    }

    private function startPhantomJS()
    {
        $root = null;

        $directory = dirname(__FILE__);

        do {
            $directory = dirname($directory);
            $composer = $directory . '/composer.json';
            if(file_exists($composer)) $root = $directory;
        } while(is_null($root) && $directory != '/');

        if ($root===null) {
            throw new Exception('Unable to locate project root directory. Perhaps you did not install this package via composer?');
        }

        $phantomJSCommand = $root.'/vendor/bin/phantomjs --webdriver=127.0.0.1:8910 &';
        exec($phantomJSCommand);
    }
}