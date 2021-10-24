<?php
declare(strict_types=1);

namespace Geometry\GeometryObject;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\Point;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\Point
 */
class PointTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getPosition
     */
    public function testPosition(): void
    {
        $position = new Position(0, 0);
        $point = new Point($position);

        static::assertSame($position, $point->getPosition());
    }
}
