<?php

namespace DivineOmega\PhantomJSLaravelTesting\Objects;

use Illuminate\Foundation\Testing\TestCase as FoundationTestCase;
use Exception;
use Facebook\WebDriver\Remote\WebDriverCapabilityType;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverDimension;
use DivineOmega\PhantomJSLaravelTesting\Objects\SessionManager;
use DivineOmega\PhantomJSLaravelTesting\Traits\CrawlerTrait;
use DivineOmega\PhantomJSLaravelTesting\Traits\AuthenticationTrait;

abstract class PhantomJSTestCase extends FoundationTestCase
{
    use CrawlerTrait;
    use AuthenticationTrait;

    private $driver;
    public $session;

    public function __construct()
    {
        $this->startPhantomJS();
        $this->setupDriver();

        $this->session = new SessionManager;

        parent::__construct();
    }

    public function createApplication()
    {
        $app = require 'bootstrap/app.php';

        $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }
    
    private function setupDriver()
    {
        $host = '127.0.0.1:8910';
        $capabilities = array(
            WebDriverCapabilityType::BROWSER_NAME => 'phantomjs',
            'phantomjs.page.settings.userAgent' => 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:25.0) Gecko/20100101 Firefox/25.0 test:useDatabaseTransactions',
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
            $vendorDir = $directory . '/vendor';

            if(file_exists($composer) && file_exists($vendorDir) && is_dir($vendorDir)) {
                $root = $directory;
            }

        } while(is_null($root) && $directory != '/');

        if ($root===null) {
            throw new Exception('Unable to locate project root directory. Perhaps you did not install this package via composer?');
        }

        $phantomJSCommand = $root.'/vendor/bin/phantomjs --webdriver=127.0.0.1:8910 &';
        exec($phantomJSCommand);
    }

    protected function session()
    {
        return $this->session;
    }
}