<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\Projection;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;
use PrinsFrank\PhpGeoSVG\Projection\EquiRectangularProjection;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Projection\EquiRectangularProjection
 */
class EquiRectangularProjectionTest extends TestCase
{
    /**
     * @covers ::getX
     */
    public function testGetX(): void
    {
        static::assertSame(180.0, (new EquiRectangularProjection())->getX(new Position(0, 0)));
        static::assertSame(0.0, (new EquiRectangularProjection())->getX(new Position(-180, 0)));
        static::assertSame(360.0, (new EquiRectangularProjection())->getX(new Position(180, 0)));
    }

    /**
     * @covers ::getY
     */
    public function testGetY(): void
    {
        static::assertSame(90.0, (new EquiRectangularProjection())->getY(new Position(0, 0)));
        static::assertSame(180.0, (new EquiRectangularProjection())->getY(new Position(0, -90)));
        static::assertSame(0.0, (new EquiRectangularProjection())->getY(new Position(0, 90)));
    }

    /**
     * @covers ::getMaxX
     */
    public function testGetMaxX(): void
    {
        static::assertSame(360.0, (new EquiRectangularProjection())->getMaxX());
    }

    /**
     * @covers ::getMaxY
     */
    public function testGetMaxY(): void
    {
        static::assertSame(180.0, (new EquiRectangularProjection())->getMaxY());
    }

    /**
     * @covers ::getMaxLatitude
     */
    public function testGetMaxLatitude(): void
    {
        static::assertSame(90.0, (new EquiRectangularProjection())->getMaxLatitude());
    }
}
