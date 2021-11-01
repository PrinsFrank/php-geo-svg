<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\Html\Elements\Text;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Html\Elements\Text\TextContent;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Html\Elements\Text\TextContent
 */
class TextContentTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getContent
     */
    public function testContentInConstructor(): void
    {
        $textContent = new TextContent();
        static::assertNull($textContent->getContent());

        $textContent = new TextContent(null);
        static::assertNull($textContent->getContent());

        $textContent = new TextContent('');
        static::assertSame('', $textContent->getContent());

        $textContent = new TextContent('foo');
        static::assertSame('foo', $textContent->getContent());
    }

    /**
     * @covers ::setContent
     * @covers ::getContent
     */
    public function testSetContent(): void
    {
        $textContent = new TextContent();
        $textContent->setContent('foo');
        static::assertSame('foo', $textContent->getContent());
        $textContent->setContent(null);
        static::assertNull($textContent->getContent());
    }
}
