<?php
declare(strict_types=1);

namespace Geometry\GeometryObject;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiPoint;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiPoint
 */
class MultiPointTest extends TestCase
{
    /**
     * @covers ::getPositions
     * @covers ::addPosition
     */
    public function testPositions(): void
    {
        $multiPoint = new MultiPoint();
        static::assertSame([], $multiPoint->getPositions());

        $position1 = new Position(0, 0);
        $multiPoint->addPosition($position1);
        static::assertSame([$position1], $multiPoint->getPositions());

        $position2 = new Position(0, 0);
        $multiPoint->addPosition($position2);
        static::assertSame([$position1, $position2], $multiPoint->getPositions());
    }
}
