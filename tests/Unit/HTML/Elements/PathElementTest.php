<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\HTML\Elements;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\HTML\Elements\PathElement;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\HTML\Elements\PathElement
 */
class PathElementTest extends TestCase
{
    /**
     * @covers ::getTagName
     */
    public function testGetTagName(): void
    {
        static::assertSame('path', (new PathElement())->getTagName());
    }
}
