<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\Projection;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;
use PrinsFrank\PhpGeoSVG\Projection\AbstractCylindricalEqualAreaProjection;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Projection\AbstractCylindricalEqualAreaProjection
 */
class AbstractCylindricalEqualAreaProjectionTest extends TestCase
{
    /**
     * @covers ::getX
     */
    public function testGetX(): void
    {
        $abstractCylindricalProjection = new class extends AbstractCylindricalEqualAreaProjection{
            public function getWidthToHeightAspectRatio(): float
            {
                return 2;
            }
        };
        static::assertSame(0.0, $abstractCylindricalProjection->getX(new Position(-180, 0)));
        static::assertSame(90.0, $abstractCylindricalProjection->getX(new Position(-90, 0)));
        static::assertSame(180.0, $abstractCylindricalProjection->getX(new Position(0, 0)));
        static::assertSame(270.0, $abstractCylindricalProjection->getX(new Position(90, 0)));
        static::assertSame(360.0, $abstractCylindricalProjection->getX(new Position(180, 0)));

        $abstractCylindricalProjection = new class extends AbstractCylindricalEqualAreaProjection{
            public function getWidthToHeightAspectRatio(): float
            {
                return 42;
            }
        };
        static::assertSame(0.0, $abstractCylindricalProjection->getX(new Position(-180, 0)));
        static::assertSame(1890.0, $abstractCylindricalProjection->getX(new Position(-90, 0)));
        static::assertSame(3780.0, $abstractCylindricalProjection->getX(new Position(0, 0)));
        static::assertSame(5670.0, $abstractCylindricalProjection->getX(new Position(90, 0)));
        static::assertSame(7560.0, $abstractCylindricalProjection->getX(new Position(180, 0)));
    }

    /**
     * @covers ::getY
     */
    public function testGetY(): void
    {
        $abstractCylindricalProjection = new class extends AbstractCylindricalEqualAreaProjection{
            public function getWidthToHeightAspectRatio(): float
            {
                return 2;
            }
        };

        static::assertSame(0.0, $abstractCylindricalProjection->getY(new Position(0, 90)));
        static::assertEqualsWithDelta(26.360, $abstractCylindricalProjection->getY(new Position(0, 45)), 0.001);
        static::assertSame(90.0, $abstractCylindricalProjection->getY(new Position(0, 0)));
        static::assertEqualsWithDelta(153.639, $abstractCylindricalProjection->getY(new Position(0, -45)), 0.001);
        static::assertSame(180.0, $abstractCylindricalProjection->getY(new Position(0, -90)));
    }

    /**
     * @covers ::getMaxX
     */
    public function testGetMaxX(): void
    {
        $abstractCylindricalProjection = new class extends AbstractCylindricalEqualAreaProjection{
            public function getWidthToHeightAspectRatio(): float
            {
                return 1;
            }
        };
        static::assertSame(180.0, $abstractCylindricalProjection->getMaxX());

        $abstractCylindricalProjection = new class extends AbstractCylindricalEqualAreaProjection{
            public function getWidthToHeightAspectRatio(): float
            {
                return 42;
            }
        };
        static::assertSame(7560.0, $abstractCylindricalProjection->getMaxX());
    }

    /**
     * @covers ::getMaxY
     */
    public function testGetMaxY(): void
    {
        $abstractCylindricalProjection = new class extends AbstractCylindricalEqualAreaProjection{
            public function getWidthToHeightAspectRatio(): float
            {
                return 1;
            }
        };

        static::assertSame(180.0, $abstractCylindricalProjection->getMaxY());
    }

    /**
     * @covers ::getMaxLatitude
     */
    public function testGetMaxLatitude(): void
    {
        $abstractCylindricalProjection = new class extends AbstractCylindricalEqualAreaProjection{
            public function getWidthToHeightAspectRatio(): float
            {
                return 1;
            }
        };

        static::assertSame(90.0, $abstractCylindricalProjection->getMaxLatitude());
    }
}
