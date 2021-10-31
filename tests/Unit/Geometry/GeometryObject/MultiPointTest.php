<?php

declare(strict_types=1);

namespace Geometry\GeometryObject;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiPoint;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\Point;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiPoint
 */
class MultiPointTest extends TestCase
{
    /**
     * @covers ::getPoints
     * @covers ::addPoint
     */
    public function testPositions(): void
    {
        $multiPoint = new MultiPoint();
        static::assertSame([], $multiPoint->getPoints());

        $point1 = new Point(new Position(0, 0));
        $multiPoint->addPoint($point1);
        static::assertSame([$point1], $multiPoint->getPoints());

        $point2 = new Point(new Position(0, 0));
        $multiPoint->addPoint($point2);
        static::assertSame([$point1, $point2], $multiPoint->getPoints());
    }
}
