<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\HTML\Elements;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\HTML\Elements\TitleElement;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\HTML\Elements\TitleElement
 */
class TitleElementTest extends TestCase
{
    /**
     * @covers ::getTagName
     */
    public function testGetTagName(): void
    {
        static::assertSame('title', (new TitleElement())->getTagName());
    }
}