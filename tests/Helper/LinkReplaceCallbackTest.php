<?php

declare(strict_types=1);

namespace Mailery\Campaign\Tracking\Tests\Helper;

use Mailery\Campaign\Tracking\Helper\LinkReplaceCallback;
use PHPUnit\Framework\TestCase;

class LinkReplaceCallbackTest extends TestCase
{

    /**
     * @return void
     */
    public function testBasic(): void
    {
        $expected = <<<TEXT
simple link <a href="https://simple.link/">link text</a>
another simple link <a href='https://simple2.link/path'>link2 text</a>
link with query string <a href="https://simple3.link/path?foo=bar&bar=foo">link3 text</a>
link without scheme <a href="//simple5.link/">link text</a>
invalid link <a href="simple6.link/">link text</a>
simple url https://simple4.link/
TEXT;

        $actual = <<<TEXT
simple link <a href="{% apply upper %}https://simple.link/{% endapply %}">link text</a>
another simple link <a href="{% apply upper %}https://simple2.link/path{% endapply %}">link2 text</a>
link with query string <a href="{% apply upper %}https://simple3.link/path?foo=bar&bar=foo{% endapply %}">link3 text</a>
link without scheme <a href="//simple5.link/">link text</a>
invalid link <a href="simple6.link/">link text</a>
simple url https://simple4.link/
TEXT;

        $replacer = new LinkReplaceCallback(function (string $link) {
            return '{% apply upper %}' . $link . '{% endapply %}';
        });

        $this->assertEquals($replacer($expected), $actual);
    }
}
