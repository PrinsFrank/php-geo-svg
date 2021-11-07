<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\Html\Factory;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Coordinator\Coordinator;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryCollection;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\LineString;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiLineString;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiPoint;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiPolygon;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\Point;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\Polygon;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;
use PrinsFrank\PhpGeoSVG\Html\Elements\CircleElement;
use PrinsFrank\PhpGeoSVG\Html\Elements\GroupElement;
use PrinsFrank\PhpGeoSVG\Html\Elements\PathElement;
use PrinsFrank\PhpGeoSVG\Html\Elements\SvgElement;
use PrinsFrank\PhpGeoSVG\Html\Elements\Text\TextContent;
use PrinsFrank\PhpGeoSVG\Html\Elements\TitleElement;
use PrinsFrank\PhpGeoSVG\Html\Factory\ElementFactory;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Html\Factory\ElementFactory
 */
class ElementFactoryTest extends TestCase
{
    /**
     * @covers ::buildForGeometryCollection
     */
    public function testBuildForGeometryCollectionWithoutGeometryObjects(): void
    {
        $coordinator = $this->createMock(Coordinator::class);
        $coordinator->expects(static::exactly(2))->method('getWidth')->with()->willReturn(200.0);
        $coordinator->expects(static::exactly(2))->method('getHeight')->with()->willReturn(100.0);

        static::assertEquals(
            (new SvgElement())
                ->setAttribute('width', '200')
                ->setAttribute('height', '100')
                ->setAttribute('viewbox', '0 0 200 100'),
            ElementFactory::buildForGeometryCollection(new GeometryCollection(), $coordinator)
        );
    }

    /**
     * @covers ::buildForGeometryCollection
     */
    public function testBuildForGeometryCollection(): void
    {
        $coordinator = $this->createMock(Coordinator::class);
        $coordinator->expects(static::exactly(2))->method('getWidth')->with()->willReturn(200.0);
        $coordinator->expects(static::exactly(2))->method('getHeight')->with()->willReturn(100.0);

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

        $coordinator->expects(static::exactly(6))
            ->method('getX')
            ->withConsecutive([$position1], [$position2], [$position3], [$position4], [$position5], [$position6])
            ->willReturnOnConsecutiveCalls(0, 0, 90, 180, 180, 90);
        $coordinator->expects(static::exactly(6))
            ->method('getY')
            ->withConsecutive([$position1], [$position2], [$position3], [$position4], [$position5], [$position6])
            ->willReturnOnConsecutiveCalls(180, 0, 90, 180, 0, 90);

        static::assertEquals(
            (new SvgElement())
                ->setAttribute('width', '200')
                ->setAttribute('height', '100')
                ->setAttribute('viewbox', '0 0 200 100')
                ->addChildElement(
                    (new PathElement())->setAttribute('d', 'M0 180 L0 0 L90 90')
                )
                ->addChildElement(
                    (new PathElement())->setAttribute('d', 'M180 180 L180 0 L90 90')
                ),
            ElementFactory::buildForGeometryCollection($geometryCollection, $coordinator)
        );
    }

    /**
     * @covers ::buildForGeometryObject
     */
    public function testBuildForGeometryObject(): void
    {
        $coordinator = $this->createMock(Coordinator::class);

        static::assertEquals((new PathElement())->setAttribute('d', ''), ElementFactory::buildForGeometryObject(new LineString(), $coordinator));
        static::assertEquals(new GroupElement(), ElementFactory::buildForGeometryObject(new MultiPoint(), $coordinator));
        static::assertEquals(new GroupElement(), ElementFactory::buildForGeometryObject(new MultiPolygon(), $coordinator));
        static::assertEquals(new GroupElement(), ElementFactory::buildForGeometryObject(new MultiLineString(), $coordinator));
        static::assertEquals(
            (new GroupElement())->addChildElement((new PathElement())->setAttribute('d', '')),
            ElementFactory::buildForGeometryObject(new Polygon(new LineString()), $coordinator)
        );
        static::assertEquals(
            (new CircleElement())->setAttribute('cx', 0)->setAttribute('cy', 0),
            ElementFactory::buildForGeometryObject(new Point(new Position(0, 1)), $coordinator)
        );
    }

    /**
     * @covers ::buildForGeometryObject
     */
    public function testBuildForGeometryObjectBuildsTitleWhenPresent(): void
    {
        static::assertEquals(
            (new PathElement())
                ->setAttribute('d', '')
                ->addChildElement(
                    (new TitleElement())->setTextContent(new TextContent('foo'))
                ),
            ElementFactory::buildForGeometryObject(
                (new LineString())->setTitle('foo'),
                $this->createMock(Coordinator::class)
            )
        );
    }

    /**
     * @covers ::buildForGeometryObject
     */
    public function testBuildForGeometryObjectSetsFeatureClassWhenPresent(): void
    {
        static::assertEquals(
            (new PathElement())
                ->setAttribute('d', '')
                ->setAttribute('data-feature-class', 'foo'),
            ElementFactory::buildForGeometryObject(
                (new LineString())->setFeatureClass('foo'),
                $this->createMock(Coordinator::class)
            )
        );
    }

    /**
     * @covers ::buildForMultiPolygon
     */
    public function testBuildForMultiPolygonWithoutPolygons(): void
    {
        static::assertEquals(
            (new GroupElement()),
            ElementFactory::buildForMultiPolygon(new MultiPolygon(), $this->createMock(Coordinator::class))
        );
    }

    /**
     * @covers ::buildForMultiPolygon
     */
    public function testBuildForMultiPolygon(): void
    {
        static::assertEquals(
            (new GroupElement())
                ->addChildElement(
                    (new GroupElement())->addChildElement(
                        (new PathElement())->setAttribute('d', '')
                    )
                )
                ->addChildElement(
                    (new GroupElement())->addChildElement(
                        (new PathElement())->setAttribute('d', '')
                    )
                ),
            ElementFactory::buildForMultiPolygon(
                (new MultiPolygon())
                    ->addPolygon(new Polygon(new LineString()))
                    ->addPolygon(new Polygon(new LineString())),
                $this->createMock(Coordinator::class)
            )
        );
    }

    /**
     * @covers ::buildForMultiLineString
     */
    public function testBuildForMultiLineStringWithoutPolygons(): void
    {
        static::assertEquals(
            (new GroupElement()),
            ElementFactory::buildForMultiLineString(new MultiLineString(), $this->createMock(Coordinator::class))
        );
    }

    /**
     * @covers ::buildForMultiLineString
     */
    public function testBuildForMultiLineString(): void
    {
        static::assertEquals(
            (new GroupElement())
                ->addChildElement((new PathElement())->setAttribute('d', ''))
                ->addChildElement((new PathElement())->setAttribute('d', '')),
            ElementFactory::buildForMultiLineString(
                (new MultiLineString())
                    ->addLineString(new LineString())
                    ->addLineString(new LineString()),
                $this->createMock(Coordinator::class)
            )
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
        $coordinator->expects(static::exactly(3))
            ->method('getX')
            ->withConsecutive([$position1], [$position2], [$position3])
            ->willReturnOnConsecutiveCalls(0, 0, 100);
        $coordinator->expects(static::exactly(3))
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
        $coordinator->expects(static::exactly(2))
            ->method('getX')
            ->withConsecutive([$position1], [$position2])
            ->willReturnOnConsecutiveCalls(-90.0, 90, 0);
        $coordinator->expects(static::exactly(2))
            ->method('getY')
            ->withConsecutive([$position1], [$position2])
            ->willReturnOnConsecutiveCalls(-90.0, 90, 0);

        static::assertEquals(
            (new GroupElement())
                ->addChildElement((new CircleElement())->setAttribute('cy', -90)->setAttribute('cx', -90))
                ->addChildElement((new CircleElement())->setAttribute('cy', 90)->setAttribute('cx', 90)),
            ElementFactory::buildForMultiPoint($multiPoint, $coordinator)
        );
    }

    /**
     * @covers ::buildForPolygon
     */
    public function testBuildForPolygonWithoutInteriorRings(): void
    {
        $lineString = new LineString();
        $position1 = new Position(0, 45);
        $lineString->addPosition($position1);
        $position2 = new Position(0, -45);
        $lineString->addPosition($position2);
        $polygon = new Polygon($lineString);

        $coordinator = $this->createMock(Coordinator::class);
        $coordinator->expects(static::exactly(2))
            ->method('getX')
            ->withConsecutive([$position1], [$position2])
            ->willReturnOnConsecutiveCalls(0, 0);
        $coordinator->expects(static::exactly(2))
            ->method('getY')
            ->withConsecutive([$position1], [$position2])
            ->willReturnOnConsecutiveCalls(0, 100);

        static::assertEquals(
            (new GroupElement())
                ->addChildElement((new PathElement())->setAttribute('d', 'M0 0 L0 100')),
            ElementFactory::buildForPolygon($polygon, $coordinator)
        );
    }

    /**
     * @covers ::buildForPolygon
     */
    public function testBuildForPolygonWithInteriorRings(): void
    {
        $lineString = new LineString();
        $position1 = new Position(0, 45);
        $lineString->addPosition($position1);
        $position2 = new Position(0, -45);
        $lineString->addPosition($position2);
        $polygon = new Polygon($lineString);

        $interiorLineString = new LineString();
        $position3 = new Position(0, 45);
        $interiorLineString->addPosition($position3);
        $position4 = new Position(0, -45);
        $interiorLineString->addPosition($position4);
        $polygon->addInteriorRing($interiorLineString);

        $coordinator = $this->createMock(Coordinator::class);
        $coordinator->expects(static::exactly(4))
            ->method('getX')
            ->withConsecutive([$position1], [$position2], [$position3], [$position4])
            ->willReturnOnConsecutiveCalls(0, 0, 100, 150);
        $coordinator->expects(static::exactly(4))
            ->method('getY')
            ->withConsecutive([$position1], [$position2], [$position3], [$position4])
            ->willReturnOnConsecutiveCalls(0, 100, 200, 300);

        static::assertEquals(
            (new GroupElement())
                ->addChildElement((new PathElement())->setAttribute('d', 'M0 0 L0 100'))
                ->addChildElement((new PathElement())->setAttribute('d', 'M100 200 L150 300')),
            ElementFactory::buildForPolygon($polygon, $coordinator)
        );
    }

    /**
     * @covers ::buildForPoint
     */
    public function testBuildForPoint(): void
    {
        $position = new Position(100, 50);

        $coordinator = $this->createMock(Coordinator::class);
        $coordinator->expects(static::once())->method('getX')->with($position)->willReturn(13.0);
        $coordinator->expects(static::once())->method('getY')->with($position)->willReturn(42.0);

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
        $coordinator->expects(static::once())->method('getX')->with($position)->willReturn(13.0);
        $coordinator->expects(static::once())->method('getY')->with($position)->willReturn(42.0);

        static::assertEquals(
            (new CircleElement())->setAttribute('cy', 42)->setAttribute('cx', 13),
            ElementFactory::buildForPosition($position, $coordinator)
        );
    }
}
