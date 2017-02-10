<?php

namespace DivineOmega\PhantomJSLaravelTesting\Traits;

use URL;
use Carbon\Carbon;

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
        $this->assertTrue($this->isStringPresentInSource($string), 'Could not find \''.$string.'\' in page source code: '.print_r($source, true));
    }

    public function waitToSee($string, $timeout = 5) 
    {
        $stringPresentInSource = $this->waitFor(function() {
            return $this->isStringPresentInSource($string);
        });

        $this->assertTrue($stringPresentInSource, 'Could not find \''.$string.'\' in page source code: '.print_r($source, true));
    }

    private function waitFor(Closure $callback, $timeout = 5)
    {
        $started = Carbon::now();

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
            
            sleep(1);

        }
    }
}