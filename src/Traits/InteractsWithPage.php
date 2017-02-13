<?php

namespace DivineOmega\PhantomJSLaravelTesting\Traits;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Exception\NoSuchElementException;

trait InteractsWithPage
{
    public function press($text) 
    {
        $this->click($text);
    }

    public function click($text)
    {
        $element = null;

        try {
            $element = $this->driver()->findElement(WebDriverBy::linkText($text));
        } catch (NoSuchElementException $e) {}

        if ($element) {
            $element->click();
            return;
        }

        try {
            $element = $this->driver()->findElement(WebDriverBy::name($text));
        } catch (NoSuchElementException $e) {}

        if ($element) {
            $element->click();
            return;
        }

        try {
            $element = $this->driver()->findElement(WebDriverBy::id($text));
        } catch (NoSuchElementException $e) {}

        if ($element) {
            $element->click();
            return;
        }

        try {
            $element = $this->driver()->findElement(WebDriverBy::partialLinkText($text));
        } catch (NoSuchElementException $e) {}

        if ($element) {
            $element->click();
            return;
        }

        try {
            $element = $this->driver()->findElement(WebDriverBy::cssSelector($text));
        } catch (NoSuchElementException $e) {}

        if ($element) {
            $element->click();
            return;
        }
    }
}