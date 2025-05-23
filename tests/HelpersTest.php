<?php

namespace Italofantone\Marky\Tests;

class HelpersTest extends TestCase
{
    public function test_markdown_with_links_helper(): void
    {
        $markdown = '[FSE](https://www.fullstackexperience.com)';
        $expected = '<p><a href="https://www.fullstackexperience.com">FSE</a></p>' . "\n";

        $this->assertEquals($expected, markdown($markdown));
    }
}