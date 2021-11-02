<?php

declare(strict_types=1);

namespace Geometry\GeometryObject;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Exception\NotImplementedException;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\GeometryObjectFactory;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\LineString;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiLineString;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiPoint;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiPolygon;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\Point;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\Polygon;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\GeometryObjectFactory
 */
class GeometryObjectFactoryTest extends TestCase
{
    /**
     * @covers ::createForGeoJsonFeatureGeometry
     */
    public function testCreateForGeoJsonFeatureGeometryThrowsExceptionForUnsupportedTypes(): void
    {
        $this->expectException(NotImplementedException::class);
        $this->expectExceptionMessage('Feature geometries of type "foo" are currently not supported');

        GeometryObjectFactory::createForGeoJsonFeatureGeometry(['type' => 'foo']);
    }

    /**
     * @covers ::createForGeoJsonFeatureGeometry
     */
    public function testCreateForGeoJsonFeatureGeometry(): void
    {
        static::assertEquals(new LineString(), GeometryObjectFactory::createForGeoJsonFeatureGeometry(['type' => 'LineString', 'coordinates' => []]));
        static::assertEquals(new MultiLineString(), GeometryObjectFactory::createForGeoJsonFeatureGeometry(['type' => 'MultiLineString', 'coordinates' => []]));
        static::assertEquals(new MultiPolygon(), GeometryObjectFactory::createForGeoJsonFeatureGeometry(['type' => 'MultiPolygon', 'coordinates' => []]));
        static::assertEquals(new Point(new Position(0, 0)), GeometryObjectFactory::createForGeoJsonFeatureGeometry(['type' => 'Point', 'coordinates' => [0, 0]]));
        static::assertEquals(new Polygon(new LineString()), GeometryObjectFactory::createForGeoJsonFeatureGeometry(['type' => 'Polygon', 'coordinates' => [[]]]));
    }

    /**
     * @covers ::createForLineStringCoordinates
     */
    public function testCreateForLineStringCoordinatesWithNoCoordinates(): void
    {
        static::assertEquals(new LineString(), GeometryObjectFactory::createForLineStringCoordinates([]));
    }

    /**
     * @covers ::createForLineStringCoordinates
     */
    public function testCreateForLineStringCoordinates(): void
    {
        static::assertEquals(
            (new LineString())->addPosition(new Position(0, 1, 2))->addPosition(new Position(3, 4)),
            GeometryObjectFactory::createForLineStringCoordinates([[0, 1, 2], [3, 4]])
        );
    }

    /**
     * @covers ::createForMultiLineStringCoordinates
     */
    public function testCreateForMultiLineStringCoordinatesWithNoCoordinates(): void
    {
        static::assertEquals(new MultiLineString(), GeometryObjectFactory::createForMultiLineStringCoordinates([]));
    }

    /**
     * @covers ::createForMultiLineStringCoordinates
     */
    public function testCreateForMultiLineStringCoordinates(): void
    {
        static::assertEquals(
            (new MultiLineString())
                ->addLineString(
                    (new LineString())
                        ->addPosition(new Position(0, 1))
                        ->addPosition(new Position(2, 3))
                )->addLineString(
                    (new LineString())
                        ->addPosition(new Position(4, 5))
                ),
            GeometryObjectFactory::createForMultiLineStringCoordinates([[[0, 1], [2, 3]], [[4, 5]]])
        );
    }

    /**
     * @covers ::createForMultiLineStringCoordinates
     */
    public function testCreateForMultiPointCoordinatesWithNoCoordinates(): void
    {
        static::assertEquals(new MultiPoint(), GeometryObjectFactory::createForMultiPointCoordinates([]));
    }

    /**
     * @covers ::createForMultiPointCoordinates
     */
    public function testCreateForMultiPointCoordinates(): void
    {
        static::assertEquals(
            (new MultiPoint())->addPoint(new Point(new Position(0, 1)))->addPoint(new Point(new Position(2, 3))),
            GeometryObjectFactory::createForMultiPointCoordinates([[0, 1], [2, 3]])
        );
    }

    /**
     * @covers ::createForMultiPolygonCoordinates
     */
    public function testCreateForMultiPolygonoordinatesWithNoCoordinates(): void
    {
        static::assertEquals(new MultiPolygon(), GeometryObjectFactory::createForMultiPolygonCoordinates([]));
    }

    /**
     * @covers ::createForMultiPolygonCoordinates
     */
    public function testCreateForMultiPolygonCoordinates(): void
    {
        static::assertEquals(
            (new MultiPolygon())
                ->addPolygon(
                    (new Polygon(
                        (new LineString())->addPosition(new Position(0, 1))
                    ))->addInteriorRing(
                        (new LineString())->addPosition(new Position(2, 3))->addPosition(new Position(4, 5))
                    )
                ),
            GeometryObjectFactory::createForMultiPolygonCoordinates([[], [[[0, 1]], [[2, 3], [4, 5]]]])
        );
    }

    /**
     * @covers ::createForPointCoordinates
     */
    public function testCreateForPointCoordinates(): void
    {
        static::assertEquals(
            new Point(new Position(1, 2)),
            GeometryObjectFactory::createForPointCoordinates([1 ,2])
        );

        static::assertEquals(
            new Point(new Position(1, 2, 3)),
            GeometryObjectFactory::createForPointCoordinates([1, 2, 3])
        );
    }

    /**
     * @covers ::createForPolygonCoordinates
     */
    public function testCreateForPolygonCoordinatesWithEmptyCoordinates(): void
    {
        static::assertNull(GeometryObjectFactory::createForPolygonCoordinates([]));
    }

    /**
     * @covers ::createForPolygonCoordinates
     */
    public function testCreateForPolygonCoordinatesWithOnlyExteriorRing(): void
    {
        static::assertEquals(
            new Polygon(
                (new LineString())->addPosition(new Position(0, 1))
            ),
            GeometryObjectFactory::createForPolygonCoordinates([[[0, 1]]])
        );
    }

    /**
     * @covers ::createForPolygonCoordinates
     */
    public function testCreateForPolygonCoordinates(): void
    {
        static::assertEquals(
            (new Polygon(
                (new LineString())->addPosition(new Position(0, 1))
            ))->addInteriorRing(
                (new LineString())->addPosition(new Position(2, 3))->addPosition(new Position(4, 5))
            )->addInteriorRing(
                (new LineString())->addPosition(new Position(6, 7))
            ),
            GeometryObjectFactory::createForPolygonCoordinates([[[0, 1]], [[2, 3], [4, 5]], [[6, 7]]])
        );
    }
}
