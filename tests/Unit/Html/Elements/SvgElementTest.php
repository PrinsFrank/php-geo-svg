<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\Html\Elements;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Html\Elements\SvgElement;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Html\Elements\SvgElement
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
