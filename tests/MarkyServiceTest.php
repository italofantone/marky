<?php

namespace Italofantone\Marky\Tests;

use Italofantone\Marky\Services\MarkyService;

class MarkyServiceTest extends TestCase
{
    public function test_markdown_with_links(): void
    {
        $markdown = '[FSE](https://www.fullstackexperience.com)';
        $expected = '<p><a href="https://www.fullstackexperience.com">FSE</a></p>' . "\n";

        $converter = new MarkyService();
        $this->assertEquals($expected, $converter->render($markdown));
    }

    public function test_markdown_with_images(): void
    {
        $markdown = '![Alt text](https://example.com/image.png)';
        $expected = '<p><img src="https://example.com/image.png" alt="Alt text" /></p>' . "\n";

        $converter = new MarkyService();
        $this->assertEquals($expected, $converter->render($markdown));
    }

    public function test_it_allow_unsafe_links_is_false(): void
    {
        $markdown = '[FSE](javascript:alert(1))';
        $expected = '<p><a>FSE</a></p>' . "\n";

        $converter = new MarkyService();
        $this->assertEquals($expected, $converter->render($markdown));
    }

    public function test_it_allow_unsafe_links_is_true(): void
    {
        config(['marky.allow_unsafe_links' => true]);

        $markdown = '[FSE](javascript:alert(1))';
        $expected = '<p><a href="javascript:alert(1)">FSE</a></p>' . "\n";
     
        $converter = new MarkyService();
        $this->assertEquals($expected, $converter->render($markdown));
    }

    public function test_it_html_input_is_escape(): void
    {
        config(['marky.html_input' => 'escape']);

        $markdown = '<script>alert(1)</script>';
        $expected = '&lt;script&gt;alert(1)&lt;/script&gt;' . "\n";

        $converter = new MarkyService();
        $this->assertEquals($expected, $converter->render($markdown));
    }

    public function test_it_html_input_is_allow(): void
    {
        config(['marky.html_input' => 'allow']);

        $markdown = '<script>alert(1)</script>';
        $expected = '<script>alert(1)</script>' . "\n";

        $converter = new MarkyService();
        $this->assertEquals($expected, $converter->render($markdown));
    }

    public function test_it_html_input_is_strip(): void
    {
        config(['marky.html_input' => 'strip']);

        $markdown = '<script>alert(1)</script>';
        $expected = '';

        $converter = new MarkyService();
        $this->assertEquals($expected, $converter->render($markdown));
    }

    public function test_it_table_of_contents(): void
    {
        $markdown = <<<MD
# Hello World
## This is a test
### This is a test
MD;

        $converter = new MarkyService();
        $html = $converter->render($markdown);

        $this->assertStringContainsString('<ul class="table-of-contents">', $html);
        $this->assertStringContainsString('<a href="#hello-world">Hello World</a>', $html);
        $this->assertStringContainsString('<a href="#this-is-a-test">This is a test</a>', $html);
        $this->assertStringContainsString('<a href="#this-is-a-test-1">This is a test</a>', $html);
        $this->assertStringContainsString('</ul>', $html);
    }

    public function test_render_code(): void
    {
        $markdown = <<<MD
```php
<?php
echo 'Hello World';
?>
```
MD;

        $expected = <<<HTML
<pre><code class="language-php">&lt;?php
echo 'Hello World';
?&gt;
</code></pre>\n
HTML;

        $converter = new MarkyService();
        $this->assertEquals($expected, $converter->render($markdown));
    }
}