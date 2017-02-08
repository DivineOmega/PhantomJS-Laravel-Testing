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
