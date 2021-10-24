<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\Coordinator;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Coordinator\Coordinator;
use PrinsFrank\PhpGeoSVG\Geometry\BoundingBox\BoundingBox;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;
use PrinsFrank\PhpGeoSVG\Projection\MercatorProjection;
use PrinsFrank\PhpGeoSVG\Projection\Projection;
use PrinsFrank\PhpGeoSVG\Scale\Scale;

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

        static::assertSame(126.0, (new Coordinator(new MercatorProjection(), $boundingBox, new Scale(3)))->getWidth());
    }

    /**
     * @covers ::__construct
     * @covers ::getHeight
     */
    public function testGetHeight(): void
    {
        $boundingBox = $this->createMock(BoundingBox::class);
        $boundingBox->expects(self::once())->method('getHeight')->with()->willReturn(42.0);

        static::assertSame(252.0, (new Coordinator(new MercatorProjection(), $boundingBox, new Scale(3)))->getHeight());
    }

    /**
     * @covers ::__construct
     * @covers ::getX
     */
    public function testGetX(): void
    {
        $position = new Position(42.0, 84.0);

        $projection = $this->createMock(Projection::class);
        $boundingBox = $this->createMock(BoundingBox::class);
        $boundingBox->expects(self::once())->method('boundX')->with($position, $projection)->willReturn(0.42);

        static::assertSame(2.52, (new Coordinator($projection, $boundingBox, new Scale(3)))->getX($position));
    }

    /**
     * @covers ::__construct
     * @covers ::getY
     */
    public function testGetY(): void
    {
        $position = new Position(84.0, 42.0);

        $projection = $this->createMock(Projection::class);
        $boundingBox = $this->createMock(BoundingBox::class);
        $boundingBox->expects(self::once())->method('boundY')->with($position, $projection)->willReturn(0.42);

        static::assertSame(2.52, (new Coordinator($projection, $boundingBox, new Scale(3)))->getY($position));
    }
}