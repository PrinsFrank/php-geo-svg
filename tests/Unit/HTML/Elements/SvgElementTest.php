<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\HTML\Elements;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\HTML\Elements\SvgElement;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\HTML\Elements\SvgElement
 */
class SvgElementTest extends TestCase
{
    /**
     * @covers ::getTagName
     */
    public function testGetTagName(): void
    {
        static::assertSame('svg', (new SvgElement())->getTagName());
    }
}