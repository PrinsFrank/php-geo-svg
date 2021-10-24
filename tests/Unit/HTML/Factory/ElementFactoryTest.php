<?php
declare(strict_types=1);

namespace HTML\Factory;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Coordinator\Coordinator;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryCollection;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\LineString;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiPoint;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\Point;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;
use PrinsFrank\PhpGeoSVG\HTML\Elements\CircleElement;
use PrinsFrank\PhpGeoSVG\HTML\Elements\GroupElement;
use PrinsFrank\PhpGeoSVG\HTML\Elements\PathElement;
use PrinsFrank\PhpGeoSVG\HTML\Elements\SvgElement;
use PrinsFrank\PhpGeoSVG\HTML\Factory\ElementFactory;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\HTML\Factory\ElementFactory
 */
class ElementFactoryTest extends TestCase
{
    /**
     * @covers ::buildForGeometryCollection
     */
    public function testBuildForGeometryCollectionWithoutGeometryObjects(): void
    {
        $coordinator = $this->createMock(Coordinator::class);
        $coordinator->expects(self::exactly(2))->method('getWidth')->with()->willReturn(200.0);
        $coordinator->expects(self::exactly(2))->method('getHeight')->with()->willReturn(100.0);

        static::assertEquals(
            (new SvgElement())
                ->setAttribute('width', '200.0')
                ->setAttribute('height', '100.0')
                ->setAttribute('viewbox', '0 0 200 100')
            ,
            ElementFactory::buildForGeometryCollection(new GeometryCollection(), $coordinator)
        );
    }

    /**
     * @covers ::buildForGeometryCollection
     */
    public function testBuildForGeometryCollection(): void
    {
        $coordinator = $this->createMock(Coordinator::class);
        $coordinator->expects(self::exactly(2))->method('getWidth')->with()->willReturn(200.0);
        $coordinator->expects(self::exactly(2))->method('getHeight')->with()->willReturn(100.0);

        $geometryCollection = new GeometryCollection();
        $geometryCollection->addGeometryObject(
            (new LineString())
                ->addPosition($position1 = new Position(-90, 90))
                ->addPosition($position2 = new Position(-90, -90))
                ->addPosition($position3 = new Position(0, 0))
        );
        $geometryCollection->addGeometryObject(
            (new LineString())
                ->addPosition($position4 = new Position(90, 90))
                ->addPosition($position5 = new Position(90, -90))
                ->addPosition($position6 = new Position(0, 0))
        );

        $coordinator->expects(self::exactly(6))
            ->method('getX')
            ->withConsecutive([$position1], [$position2], [$position3], [$position4], [$position5], [$position6])
            ->willReturnOnConsecutiveCalls(0, 0, 90, 180, 180, 90);
        $coordinator->expects(self::exactly(6))
            ->method('getY')
            ->withConsecutive([$position1], [$position2], [$position3], [$position4], [$position5], [$position6])
            ->willReturnOnConsecutiveCalls(180, 0, 90, 180, 0, 90);

        static::assertEquals(
            (new SvgElement())
                ->setAttribute('width', '200.0')
                ->setAttribute('height', '100.0')
                ->setAttribute('viewbox', '0 0 200 100')
                ->addChildElement(
                    (new PathElement())->setAttribute('d', 'M0 180 L0 0 L90 90')
                )
                ->addChildElement(
                    (new PathElement())->setAttribute('d', 'M180 180 L180 0 L90 90')
                )
            ,
            ElementFactory::buildForGeometryCollection($geometryCollection, $coordinator)
        );
    }

    /**
     * @covers ::buildForLineString
     */
    public function testBuildForLineString(): void
    {
        $lineString = new LineString();
        $position1 = new Position(0, 45);
        $lineString->addPosition($position1);
        $position2 = new Position(0, -45);
        $lineString->addPosition($position2);
        $position3 = new Position(90, 0);
        $lineString->addPosition($position3);

        $coordinator = $this->createMock(Coordinator::class);
        $coordinator->expects(self::exactly(3))
            ->method('getX')
            ->withConsecutive([$position1], [$position2], [$position3])
            ->willReturnOnConsecutiveCalls(0, 0, 100);
        $coordinator->expects(self::exactly(3))
            ->method('getY')
            ->withConsecutive([$position1], [$position2], [$position3])
            ->willReturnOnConsecutiveCalls(0, 100, 50);

        static::assertEquals(
            (new PathElement())->setAttribute('d', 'M0 0 L0 100 L100 50'),
            ElementFactory::buildForLineString($lineString, $coordinator)
        );
    }

    /**
     * @covers ::buildForMultiPoint
     */
    public function testBuildForMultiPointWithoutPoints(): void
    {
        static::assertEquals(new GroupElement(), ElementFactory::buildForMultiPoint(new MultiPoint(), $this->createMock(Coordinator::class)));
    }

    /**
     * @covers ::buildForMultiPoint
     */
    public function testBuildForMultiPoint(): void
    {
        $multiPoint = new MultiPoint();
        $position1 = new Position(-90, -90);
        $point1 = new Point($position1);
        $multiPoint->addPoint($point1);

        $position2 = new Position(90, 90);
        $point2 = new Point($position2);
        $multiPoint->addPoint($point2);

        $coordinator = $this->createMock(Coordinator::class);
        $coordinator->expects(self::exactly(2))
            ->method('getX')
            ->withConsecutive([$position1], [$position2])
            ->willReturnOnConsecutiveCalls(-90.0, 90,0);
        $coordinator->expects(self::exactly(2))
            ->method('getY')
            ->withConsecutive([$position1], [$position2])
            ->willReturnOnConsecutiveCalls(-90.0, 90,0);

        static::assertEquals(
            (new GroupElement())
                ->addChildElement((new CircleElement())->setAttribute('cy', -90)->setAttribute('cx', -90))
                ->addChildElement((new CircleElement())->setAttribute('cy', 90)->setAttribute('cx', 90)),
            ElementFactory::buildForMultiPoint($multiPoint, $coordinator)
        );
    }

    /**
     * @covers ::buildForPoint
     */
    public function testBuildForPoint(): void
    {
        $position = new Position(100, 50);

        $coordinator = $this->createMock(Coordinator::class);
        $coordinator->expects(self::once())->method('getX')->with($position)->willReturn(13.0);
        $coordinator->expects(self::once())->method('getY')->with($position)->willReturn(42.0);

        static::assertEquals(
            (new CircleElement())->setAttribute('cy', 42)->setAttribute('cx', 13),
            ElementFactory::buildForPoint(new Point($position), $coordinator)
        );
    }

    /**
     * @covers ::buildForPosition
     */
    public function testBuildForPositiont(): void
    {
        $position = new Position(100, 50);

        $coordinator = $this->createMock(Coordinator::class);
        $coordinator->expects(self::once())->method('getX')->with($position)->willReturn(13.0);
        $coordinator->expects(self::once())->method('getY')->with($position)->willReturn(42.0);

        static::assertEquals(
            (new CircleElement())->setAttribute('cy', 42)->setAttribute('cx', 13),
            ElementFactory::buildForPosition($position, $coordinator)
        );
    }
}
