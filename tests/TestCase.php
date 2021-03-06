<?php

namespace Tests;

use DOMDocument;
use DOMXPath;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    public function assertDomHasInput($response, $type, $name, $attributes = [])
    {
        $attributes['type'] = $type;
        $attributes['name'] = $name;

        $this->assertDomHasTag($response, 'input', $attributes);
    }

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
            "Expected at least one '$selector' tag in DOM."
        );
    }

    protected function buildXpathSelector($tagName, $attributes)
    {
        $attrWithConcatenatedKeyValue = [];

        foreach ($attributes as $attribute => $value) {
            array_push($attrWithConcatenatedKeyValue, "@$attribute='$value'");
        }

        $selector = implode(' and ', $attrWithConcatenatedKeyValue);

        return ".//$tagName" . ($selector ? "[$selector]" : '');
    }

    protected function query($html, $selector)
    {
        $dom = new DOMDocument();

        $dom->loadHTML($html);

        $xpath = new DOMXPath($dom);

        return $xpath->query($selector);
    }
}
