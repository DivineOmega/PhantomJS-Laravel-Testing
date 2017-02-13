<?php

namespace DivineOmega\PhantomJSLaravelTesting\Traits;

use URL;
use Carbon\Carbon;
use Closure;

trait CrawlerTrait
{
    public function visit($uri) 
    {
        if (strpos($uri, '/')===0) {
            $uri = URL::to($uri);
        }
        $this->driver()->get($uri);
    }

    private function isStringPresentInSource($string)
    {
        $source = $this->driver()->getPageSource();

        $stringPresentInSource = false;

        if (strpos($source, $string)!==false) {
            $stringPresentInSource = true;
        }

        return $stringPresentInSource;
    }

    public function see($string)
    {
        $this->assertTrue($this->isStringPresentInSource($string), 'Could not find \''.$string.'\' in page source code: '.print_r($this->driver()->getPageSource(), true));
    }

    public function waitToSee($string, $timeout = 5) 
    {
        $stringPresentInSource = $this->waitFor(function() use ($string) {
            return $this->isStringPresentInSource($string);
        });

        $this->assertTrue($stringPresentInSource, 'Could not find \''.$string.'\' in page source code: '.print_r($this->driver()->getPageSource(), true));
    }

    private function waitFor(Closure $callback, $timeout = 5)
    {
        $started = Carbon::now();

        $this->delay();

        while(true) {

            // If we get a positive result from the callback, return it
            if ($result = $callback()) {
                return $result;
                break;
            }

            // If the timouet has exceeded, return false
            if ($started->lt(Carbon::now()->subSeconds($timeout))) {
                return false;
            }
            
            $this->delay();

        }
    }

    private function delay()
    {
        usleep(1000);
    }

    public function seePageIs($uri)
    {
        $currentUrl = $this->driver()->getCurrentURL();
        $currentUrlPath = parse_url($url, PHP_URL_PATH);
        $urlMatches = (strpos($currentUrlPath, $uri)===0);
        return $urlMatches;
    }
}