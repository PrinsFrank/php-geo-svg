<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\HTML\Elements;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\HTML\Elements\CircleElement;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\HTML\Elements\CircleElement
 */
class CircleElementTest extends TestCase
{
    /**
     * @covers ::getTagName
     */
    public function testGetTagName(): void
    {
        static::assertSame('circle', (new CircleElement())->getTagName());
    }
}
