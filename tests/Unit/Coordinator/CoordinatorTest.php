<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\Coordinator;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Coordinator\Coordinator;
use PrinsFrank\PhpGeoSVG\Geometry\BoundingBox\BoundingBox;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;
use PrinsFrank\PhpGeoSVG\Projection\MercatorProjection;
use PrinsFrank\PhpGeoSVG\Projection\Projection;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Coordinator\Coordinator
 */
class CoordinatorTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getWidth
     */
    public function testGetWidth(): void
    {
        $boundingBox = $this->createMock(BoundingBox::class);
        $boundingBox->expects(self::once())->method('getWidth')->with()->willReturn(42.0);

        static::assertSame(42.0, (new Coordinator(new MercatorProjection(), $boundingBox))->getWidth());
    }

    /**
     * @covers ::__construct
     * @covers ::getHeight
     */
    public function testGetHeight(): void
    {
        $boundingBox = $this->createMock(BoundingBox::class);
        $boundingBox->expects(self::once())->method('getHeight')->with()->willReturn(42.0);

        static::assertSame(42.0, (new Coordinator(new MercatorProjection(), $boundingBox))->getHeight());
    }

    /**
     * @covers ::__construct
     * @covers ::getX
     */
    public function testGetX(): void
    {
        $projection = $this->createMock(Projection::class);
        $projection->expects(self::once())->method('getX')->with()->willReturn(42.0);

        $boundingBox = $this->createMock(BoundingBox::class);
        $boundingBox->expects(self::once())->method('boundX')->with(42.0)->willReturn(0.42);

        static::assertSame(0.42, (new Coordinator($projection, $boundingBox))->getX(new Position(42.0, 84.0)));
    }

    /**
     * @covers ::__construct
     * @covers ::getY
     */
    public function testGetY(): void
    {
        $projection = $this->createMock(Projection::class);
        $projection->expects(self::once())->method('getY')->with()->willReturn(42.0);

        $boundingBox = $this->createMock(BoundingBox::class);
        $boundingBox->expects(self::once())->method('boundY')->with(42.0)->willReturn(0.42);

        static::assertSame(0.42, (new Coordinator($projection, $boundingBox))->getY(new Position(84.0, 42.0)));
    }
}