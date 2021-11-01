<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\Html\Elements;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Html\Elements\PathElement;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Html\Elements\PathElement
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
