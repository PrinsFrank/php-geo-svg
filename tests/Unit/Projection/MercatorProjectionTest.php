<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\Projection;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;
use PrinsFrank\PhpGeoSVG\Projection\MercatorProjection;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Projection\MercatorProjection
 */
class MercatorProjectionTest extends TestCase
{
    /**
     * @covers ::getX
     */
    public function testGetX(): void
    {
        static::assertSame(0.0, (new MercatorProjection())->getX(new Position(-180.0, 0)));
        static::assertSame(45.0, (new MercatorProjection())->getX(new Position(-90.0, 0)));
        static::assertSame(90.0, (new MercatorProjection())->getX(new Position(0.0, 0)));
        static::assertSame(135.0, (new MercatorProjection())->getX(new Position(90.0, 0)));
        static::assertSame(180.0, (new MercatorProjection())->getX(new Position(180.0, 0)));
    }

    /**
     * @covers ::getY
     */
    public function testGetY(): void
    {
        static::assertEqualsWithDelta(0.3, (new MercatorProjection())->getY(new Position(0, 90)), 0.1);
        static::assertEqualsWithDelta(64.7, (new MercatorProjection())->getY(new Position(0, 45)), 0.1);
        static::assertEqualsWithDelta(90.0, (new MercatorProjection())->getY(new Position(0, 0)), 0.1);
        static::assertEqualsWithDelta(115.2, (new MercatorProjection())->getY(new Position(0, -45)), 0.1);
        static::assertEqualsWithDelta(179.6, (new MercatorProjection())->getY(new Position(0, -90)), 0.1);
    }

    /**
     * @covers ::getMaxX
     */
    public function testGetMaxX(): void
    {
        static::assertSame(180.0, (new MercatorProjection())->getMaxX());
    }

    /**
     * @covers ::getMaxY
     */
    public function testGetMaxY(): void
    {
        static::assertSame(180.0, (new MercatorProjection())->getMaxY());
    }

    /**
     * @covers ::getMaxLatitude
     */
    public function testGetMaxLatitude(): void
    {
        static::assertSame(85.0, (new MercatorProjection())->getMaxLatitude());
    }
}
