<?php

namespace Tests;

use DOMDocument;
use DOMXPath;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function assertHasLink($response, $href)
    {
        $dom = new DOMDocument();

        $dom->loadHTML($response->getContent());

        $xpath = new DOMXPath($dom);

        $this->assertGreaterThanOrEqual(
            1,
            $xpath->query("//a[@href='$href']")->count()
        );
    }
}
