<?php

namespace DivineOmega\PhantomJSLaravelTesting\Traits;

trait InteractsWithPage
{
    public function press($text) 
    {
        $this->click($text);
    }

    public function click($text)
    {
        $element = $this->driver()->findElement(WebDriverBy::linkText($text));

        if ($element) {
            $element->click();
            return;
        }

        $element = $this->driver()->findElement(WebDriverBy::name($name));

        if ($element) {
            $element->click();
            return;
        }

        $element = $this->driver()->findElement(WebDriverBy::id($text));

        if ($element) {
            $element->click();
            return;
        }

        $element = $this->driver()->findElement(WebDriverBy::partialLinkText($text));

        if ($element) {
            $element->click();
            return;
        }

        $element = $this->driver()->findElement(WebDriverBy::cssSelector($text));

        if ($element) {
            $element->click();
            return;
        }
    }
}