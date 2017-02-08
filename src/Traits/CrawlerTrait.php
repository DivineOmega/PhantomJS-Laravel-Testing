<?php

namespace DivineOmega\PhantomJSLaravelTesting\Traits;

trait CrawlerTrait
{
    public function visit($uri) 
    {
        $this->driver()->get($uri);
    }

    public function see($string)
    {
        $source = $this->driver()->getPageSource();

        $stringPresentInSource = false;

        if (strpos($source, $string)!==false) {
            $stringPresentInSource = true;
        }

        $this->assertTrue($stringPresentInSource, 'Could not find \''.$string.'\' in page source code.');
    }
}