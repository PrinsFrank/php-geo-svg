<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Feature;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryCollectionFactory;
use PrinsFrank\PhpGeoSVG\GeoSVG;
use PrinsFrank\PhpGeoSVG\Projection\EquiRectangularProjection;
use PrinsFrank\PhpGeoSVG\Projection\MercatorProjection;
use PrinsFrank\PhpGeoSVG\Projection\MillerProjection;

/**
 * @coversNothing
 */
class GeoSVGWithProjectionTest extends TestCase
{
    public function testEquiRectangularProjection(): void
    {
        (new GeoSVG(new EquiRectangularProjection()))
            ->toFile(
                GeometryCollectionFactory::createFromGeoJSONFilePath(dirname(__DIR__, 2) . '/vendor/prinsfrank/natural-earth-vector-geojson-only/geojson/ne_10m_admin_0_countries.geojson'),
                __DIR__ . '/actual/world-equirectangular.svg'
            );

        self::assertFileEquals(__DIR__ . '/expected/world-equirectangular.svg', __DIR__ . '/actual/world-equirectangular.svg');
    }

    public function testMercatorProjection(): void
    {
        (new GeoSVG(new MercatorProjection()))
            ->toFile(
                GeometryCollectionFactory::createFromGeoJSONFilePath(dirname(__DIR__, 2) . '/vendor/prinsfrank/natural-earth-vector-geojson-only/geojson/ne_10m_admin_0_countries.geojson'),
                __DIR__ . '/actual/world-mercator.svg'
            );

        self::assertFileEquals(__DIR__ . '/expected/world-mercator.svg', __DIR__ . '/actual/world-mercator.svg');
    }

    public function testMillerProjection(): void
    {
        (new GeoSVG(new MillerProjection()))
            ->toFile(
                GeometryCollectionFactory::createFromGeoJSONFilePath(dirname(__DIR__, 2) . '/vendor/prinsfrank/natural-earth-vector-geojson-only/geojson/ne_10m_admin_0_countries.geojson'),
                __DIR__ . '/actual/world-miller.svg'
            );

        self::assertFileEquals(__DIR__ . '/expected/world-miller.svg', __DIR__ . '/actual/world-miller.svg');
    }
}
