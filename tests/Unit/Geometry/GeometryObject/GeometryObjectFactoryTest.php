<?php

declare(strict_types=1);

namespace Geometry\GeometryObject;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Exception\NotImplementedException;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\GeometryObjectFactory;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\LineString;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiLineString;
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
    public function testCreateForGeoJsonFeatuerGeometryThrowsExceptionForUnsupportedTypes(): void
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
}
