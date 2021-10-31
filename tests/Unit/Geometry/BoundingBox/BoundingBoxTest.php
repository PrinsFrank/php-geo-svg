<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\Geometry\BoundingBox;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Exception\InvalidBoundingBoxException;
use PrinsFrank\PhpGeoSVG\Geometry\BoundingBox\BoundingBox;
use PrinsFrank\PhpGeoSVG\Geometry\BoundingBox\BoundingBoxPosition;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;
use PrinsFrank\PhpGeoSVG\Projection\MercatorProjection;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Geometry\BoundingBox\BoundingBox
 */
class BoundingBoxTest extends TestCase
{
    /**
     * -------------------------------------------------------------
     *   |      |      |######|######|######|######|      |      | Default View box
     *   |   xxx|xxx   |      |      |      |      |      |      | Unnecessarily in wrapped context
     *   |      |      |      |      |   vvv|vvv   |      |      | Could be rotated into this context resulting in the same view
     *   |      |      |######|######|######|######|      |      | Default View box
     * -------------------------------------------------------------
     * -360   -270   -180    -90     0     90     180    270    360
     *
     * @covers ::__construct
     */
    public function testViewBoxUnnecessarilyRotatedWest(): void
    {
        $this->expectException(InvalidBoundingBoxException::class);
        $this->expectExceptionMessage('The bounding box is unnecessarily rotated. Use a maxLongitude of "135" instead to achieve the same bound.');

        new BoundingBox(new BoundingBoxPosition(-315, 0), new BoundingBoxPosition(-225, 0));
    }

    /**
     * -------------------------------------------------------------
     *   |      |      |######|######|######|######|      |      | Default View box
     *   |      |      |      |      |      |      |   xxx|xxx   | Unnecessarily in rotated context
     *   |      |      |   vvv|vvv   |      |      |      |      | Could be rotated into this context resulting in the same view
     *   |      |      |######|######|######|######|      |      | Default View box
     * -------------------------------------------------------------
     * -360   -270   -180    -90     0     90     180    270    360
     *
     * @covers ::__construct
     */
    public function testViewBoxUnnecessarilyRotatedEast(): void
    {
        $this->expectException(InvalidBoundingBoxException::class);
        $this->expectExceptionMessage('The bounding box is unnecessarily rotated. Use a minLongitude of "-135" instead to achieve the same bound.');

        new BoundingBox(new BoundingBoxPosition(225, 0), new BoundingBoxPosition(315, 0));
    }

    /**
     * @covers ::__construct
     */
    public function testNorthSouthBoundingBoxFlipped(): void
    {
        $this->expectException(InvalidBoundingBoxException::class);
        $this->expectExceptionMessage('The latitude of the NorthEastern coordinate (-45) is south of the SouthWestern coordinate (45)');

        new BoundingBox(new BoundingBoxPosition(0, 45), new BoundingBoxPosition(0, -45));
    }

    /**
     * @covers ::__construct
     */
    public function testEastWestBoundingBoxFlipped(): void
    {
        $this->expectException(InvalidBoundingBoxException::class);
        $this->expectExceptionMessage('The longitude of the NorthEastern coordinate (-90) is west of the SouthWestern coordinate (90)');

        new BoundingBox(new BoundingBoxPosition(90, 0), new BoundingBoxPosition(-90, 0));
    }

    /**
     * @covers ::__construct
     * @covers ::getWidth
     */
    public function testGetWidth(): void
    {
        static::assertSame(360.0, (new BoundingBox(new BoundingBoxPosition(-180, 0), new BoundingBoxPosition(180, 0)))->getWidth());
        static::assertSame(90.0, (new BoundingBox(new BoundingBoxPosition(-90, 0), new BoundingBoxPosition(0, 0)))->getWidth());
        static::assertSame(180.0, (new BoundingBox(new BoundingBoxPosition(-90, 0), new BoundingBoxPosition(90, 0)))->getWidth());
        static::assertSame(90.0, (new BoundingBox(new BoundingBoxPosition(0, 0), new BoundingBoxPosition(90, 0)))->getWidth());
        static::assertSame(0.0, (new BoundingBox(new BoundingBoxPosition(90, 0), new BoundingBoxPosition(90, 0)))->getWidth());
    }

    /**
     * @covers ::__construct
     * @covers ::getHeight
     */
    public function testGetHeight(): void
    {
        static::assertSame(0.0, (new BoundingBox(new BoundingBoxPosition(0, 0), new BoundingBoxPosition(0, 0)))->getHeight());
        static::assertSame(180.0, (new BoundingBox(new BoundingBoxPosition(0, -90), new BoundingBoxPosition(0, 90)))->getHeight());
        static::assertSame(90.0, (new BoundingBox(new BoundingBoxPosition(0, -90), new BoundingBoxPosition(0, 0)))->getHeight());
        static::assertSame(90.0, (new BoundingBox(new BoundingBoxPosition(0, 0), new BoundingBoxPosition(0, 90)))->getHeight());
    }

    /**
     * @covers ::boundX
     */
    public function testBoundX(): void
    {
        $position = new Position(90, 45);
        $projection = $this->createMock(MercatorProjection::class);
        $projection->expects(static::exactly(3))
            ->method('getX')
            ->withConsecutive([$position], [$this->equalTo(new Position(0, 0))], [$this->equalTo(new Position(-180, 0))])
            ->willReturnOnConsecutiveCalls(30.0, 20.0, 50.0);

        static::assertSame(
            60.0,
            (new BoundingBox(new BoundingBoxPosition(0, 0), new BoundingBoxPosition(180, 90)))->boundX($position, $projection)
        );
    }

    /**
     * @covers ::boundY
     */
    public function testBoundY(): void
    {
        $position = new Position(90, 45);
        $projection = $this->createMock(MercatorProjection::class);
        $projection->expects(static::exactly(3))
            ->method('getY')
            ->withConsecutive([$position], [$this->equalTo(new Position(0, 90))], [$this->equalTo(new Position(0, 0))])
            ->willReturnOnConsecutiveCalls(30.0, 20.0, 50.0);

        static::assertSame(
            60.0,
            (new BoundingBox(new BoundingBoxPosition(0, 0), new BoundingBoxPosition(180, 90)))->boundY($position, $projection)
        );
    }
}
