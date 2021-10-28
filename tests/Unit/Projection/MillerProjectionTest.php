<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\Projection;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;
use PrinsFrank\PhpGeoSVG\Projection\MillerProjection;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Projection\MillerProjection
 */
class MillerProjectionTest extends TestCase
{
    /**
     * @covers ::getY
     */
    public function testGetY(): void
    {
        static::assertEqualsWithDelta(0.3, (new MillerProjection())->getY(new Position(0, 90)), 0.1);
        static::assertEqualsWithDelta(51.8, (new MillerProjection())->getY(new Position(0, 45)), 0.1);
        static::assertEqualsWithDelta(72.0, (new MillerProjection())->getY(new Position(0, 0)), 0.1);
        static::assertEqualsWithDelta(92.1, (new MillerProjection())->getY(new Position(0, -45)), 0.1);
        static::assertEqualsWithDelta(143.7, (new MillerProjection())->getY(new Position(0, -90)), 0.1);
    }

    /**
     * @covers ::getMaxY
     */
    public function testGetMaxY(): void
    {
        static::assertSame(144.0, (new MillerProjection())->getMaxY());
    }
}
