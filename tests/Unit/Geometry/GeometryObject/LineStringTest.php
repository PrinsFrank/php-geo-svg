<?php

declare(strict_types=1);

namespace Geometry\GeometryObject;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\LineString;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\LineString
 */
class LineStringTest extends TestCase
{
    /**
     * @covers ::getPositions
     * @covers ::addPosition
     */
    public function testGetAddPositions(): void
    {
        $lineString = new LineString();
        static::assertSame([], $lineString->getPositions());

        $position1 = new Position(0, 0);
        $lineString->addPosition($position1);
        static::assertSame([$position1], $lineString->getPositions());

        $position2 = new Position(0, 0);
        $lineString->addPosition($position2);
        static::assertSame([$position1, $position2], $lineString->getPositions());
    }
}
