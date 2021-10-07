<?php

namespace Tests;

use DOMDocument;
use DOMXPath;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function assertDomHasLink($response, $href)
    {
        $this->assertDomHasTag($response, 'a', [
            'href' => $href
        ]);
    }

    public function assertDomHasTag($response, $tagName, $attributes = [])
    {
        $selector = $this->buildXpathSelector($tagName, $attributes);

        $nodeList = $this->query(
            $response->getContent(),
            $selector
        );

        $this->assertGreaterThan(
            0,
            $nodeList->count(),
            "Expected at least one '$selector' tag in DOM"
        );
    }

    public function buildXpathSelector($tagName, $attributes)
    {
        $selector = "//$tagName";

        foreach ($attributes as $attribute => $value) {
            $selector .= "[@$attribute='$value']";
        }

        return $selector;
    }

    protected function query($html, $selector)
    {
        $dom = new DOMDocument();

        $dom->loadHTML($html);

        $xpath = new DOMXPath($dom);

        return $xpath->query($selector);
    }
}
