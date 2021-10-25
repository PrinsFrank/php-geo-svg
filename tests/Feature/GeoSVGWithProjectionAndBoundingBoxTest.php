<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Feature;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Geometry\BoundingBox\BoundingBox;
use PrinsFrank\PhpGeoSVG\Geometry\BoundingBox\BoundingBoxPosition;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryCollectionFactory;
use PrinsFrank\PhpGeoSVG\GeoSVG;
use PrinsFrank\PhpGeoSVG\Projection\EquiRectangularProjection;
use PrinsFrank\PhpGeoSVG\Projection\MercatorProjection;
use PrinsFrank\PhpGeoSVG\Projection\MillerProjection;
use PrinsFrank\PhpGeoSVG\Scale\Scale;

/**
 * @coversNothing
 */
class GeoSVGWithProjectionAndBoundingBoxTest extends TestCase
{
    public function testEquiRectangularProjection(): void
    {
        (new GeoSVG(new EquiRectangularProjection(), new BoundingBox(new BoundingBoxPosition( 3.5, 50.8), new BoundingBoxPosition( 7.2, 53.5))))
            ->setScale(new Scale(10))
            ->toFile(
                GeometryCollectionFactory::createFromGeoJSONFilePath(dirname(__DIR__, 2) . '/vendor/prinsfrank/natural-earth-vector-geojson-only/geojson/ne_110m_admin_0_countries.geojson'),
                __DIR__ . '/actual/world-equirectangular-bounded.svg'
            );

        self::assertFileEquals(__DIR__ . '/expected/world-equirectangular-bounded.svg', __DIR__ . '/actual/world-equirectangular-bounded.svg');
    }

    public function testMercatorProjection(): void
    {
        (new GeoSVG(new MercatorProjection(), new BoundingBox(new BoundingBoxPosition( 3.5, 50.8), new BoundingBoxPosition( 7.2, 53.5))))
            ->setScale(new Scale(10))
            ->toFile(
                GeometryCollectionFactory::createFromGeoJSONFilePath(dirname(__DIR__, 2) . '/vendor/prinsfrank/natural-earth-vector-geojson-only/geojson/ne_110m_admin_0_countries.geojson'),
                __DIR__ . '/actual/world-mercator-bounded.svg'
            );

        self::assertFileEquals(__DIR__ . '/expected/world-mercator-bounded.svg', __DIR__ . '/actual/world-mercator-bounded.svg');
    }

    public function testMillerProjection(): void
    {
        (new GeoSVG(new MillerProjection(), new BoundingBox(new BoundingBoxPosition( 3.5, 50.8), new BoundingBoxPosition( 7.2, 53.5))))
            ->setScale(new Scale(10))
            ->toFile(
                GeometryCollectionFactory::createFromGeoJSONFilePath(dirname(__DIR__, 2) . '/vendor/prinsfrank/natural-earth-vector-geojson-only/geojson/ne_110m_admin_0_countries.geojson'),
                __DIR__ . '/actual/world-miller-bounded.svg'
            );

        self::assertFileEquals(__DIR__ . '/expected/world-miller-bounded.svg', __DIR__ . '/actual/world-miller-bounded.svg');
    }
}
