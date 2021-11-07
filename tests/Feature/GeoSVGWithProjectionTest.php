<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Feature;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryCollectionFactory;
use PrinsFrank\PhpGeoSVG\GeoSVG;
use PrinsFrank\PhpGeoSVG\Projection\BalthasartProjection;
use PrinsFrank\PhpGeoSVG\Projection\BehrmannProjection;
use PrinsFrank\PhpGeoSVG\Projection\EquiRectangularProjection;
use PrinsFrank\PhpGeoSVG\Projection\GallPetersProjection;
use PrinsFrank\PhpGeoSVG\Projection\HoboDyerProjection;
use PrinsFrank\PhpGeoSVG\Projection\LambertProjection;
use PrinsFrank\PhpGeoSVG\Projection\MercatorProjection;
use PrinsFrank\PhpGeoSVG\Projection\MillerProjection;
use PrinsFrank\PhpGeoSVG\Projection\SmythProjection;
use PrinsFrank\PhpGeoSVG\Projection\ToblersWorldInASquareProjection;
use PrinsFrank\PhpGeoSVG\Projection\TrystanEdwardsProjection;
use PrinsFrank\PhpGeoSVG\Scale\Scale;

/**
 * @coversNothing
 */
class GeoSVGWithProjectionTest extends TestCase
{
    public function testBalthasartProjection(): void
    {
        (new GeoSVG(new BalthasartProjection()))
            ->setScale(new Scale(1))
            ->toFile(
                GeometryCollectionFactory::createFromGeoJSONFilePath(dirname(__DIR__, 2) . '/vendor/prinsfrank/natural-earth-vector-geojson-only/geojson/ne_110m_admin_0_countries.geojson'),
                __DIR__ . '/actual/world-balthasart.svg'
            );

        static::assertFileEquals(__DIR__ . '/expected/world-balthasart.svg', __DIR__ . '/actual/world-balthasart.svg');
    }

    public function testBehrmannProjection(): void
    {
        (new GeoSVG(new BehrmannProjection()))
            ->setScale(new Scale(1))
            ->toFile(
                GeometryCollectionFactory::createFromGeoJSONFilePath(dirname(__DIR__, 2) . '/vendor/prinsfrank/natural-earth-vector-geojson-only/geojson/ne_110m_admin_0_countries.geojson'),
                __DIR__ . '/actual/world-behrmann.svg'
            );

        static::assertFileEquals(__DIR__ . '/expected/world-behrmann.svg', __DIR__ . '/actual/world-behrmann.svg');
    }

    public function testEquiRectangularProjection(): void
    {
        (new GeoSVG(new EquiRectangularProjection()))
            ->toFile(
                GeometryCollectionFactory::createFromGeoJSONFilePath(dirname(__DIR__, 2) . '/vendor/prinsfrank/natural-earth-vector-geojson-only/geojson/ne_110m_admin_0_countries.geojson'),
                __DIR__ . '/actual/world-equirectangular.svg'
            );

        static::assertFileEquals(__DIR__ . '/expected/world-equirectangular.svg', __DIR__ . '/actual/world-equirectangular.svg');
    }

    public function testGallPetersProjection(): void
    {
        (new GeoSVG(new GallPetersProjection()))
            ->setScale(new Scale(1))
            ->toFile(
                GeometryCollectionFactory::createFromGeoJSONFilePath(dirname(__DIR__, 2) . '/vendor/prinsfrank/natural-earth-vector-geojson-only/geojson/ne_110m_admin_0_countries.geojson'),
                __DIR__ . '/actual/world-gall-peters.svg'
            );

        static::assertFileEquals(__DIR__ . '/expected/world-gall-peters.svg', __DIR__ . '/actual/world-gall-peters.svg');
    }

    public function testHoboDyerProjection(): void
    {
        (new GeoSVG(new HoboDyerProjection()))
            ->setScale(new Scale(1))
            ->toFile(
                GeometryCollectionFactory::createFromGeoJSONFilePath(dirname(__DIR__, 2) . '/vendor/prinsfrank/natural-earth-vector-geojson-only/geojson/ne_110m_admin_0_countries.geojson'),
                __DIR__ . '/actual/world-hobo-dyer.svg'
            );

        static::assertFileEquals(__DIR__ . '/expected/world-hobo-dyer.svg', __DIR__ . '/actual/world-hobo-dyer.svg');
    }

    public function testLambertProjection(): void
    {
        (new GeoSVG(new LambertProjection()))
            ->setScale(new Scale(1))
            ->toFile(
                GeometryCollectionFactory::createFromGeoJSONFilePath(dirname(__DIR__, 2) . '/vendor/prinsfrank/natural-earth-vector-geojson-only/geojson/ne_110m_admin_0_countries.geojson'),
                __DIR__ . '/actual/world-lambert.svg'
            );

        static::assertFileEquals(__DIR__ . '/expected/world-lambert.svg', __DIR__ . '/actual/world-lambert.svg');
    }

    public function testMercatorProjection(): void
    {
        (new GeoSVG(new MercatorProjection()))
            ->toFile(
                GeometryCollectionFactory::createFromGeoJSONFilePath(dirname(__DIR__, 2) . '/vendor/prinsfrank/natural-earth-vector-geojson-only/geojson/ne_110m_admin_0_countries.geojson'),
                __DIR__ . '/actual/world-mercator.svg'
            );

        static::assertFileEquals(__DIR__ . '/expected/world-mercator.svg', __DIR__ . '/actual/world-mercator.svg');
    }

    public function testMillerProjection(): void
    {
        (new GeoSVG(new MillerProjection()))
            ->toFile(
                GeometryCollectionFactory::createFromGeoJSONFilePath(dirname(__DIR__, 2) . '/vendor/prinsfrank/natural-earth-vector-geojson-only/geojson/ne_110m_admin_0_countries.geojson'),
                __DIR__ . '/actual/world-miller.svg'
            );

        static::assertFileEquals(__DIR__ . '/expected/world-miller.svg', __DIR__ . '/actual/world-miller.svg');
    }

    public function testSmythProjection(): void
    {
        (new GeoSVG(new SmythProjection()))
            ->toFile(
                GeometryCollectionFactory::createFromGeoJSONFilePath(dirname(__DIR__, 2) . '/vendor/prinsfrank/natural-earth-vector-geojson-only/geojson/ne_110m_admin_0_countries.geojson'),
                __DIR__ . '/actual/world-smyth.svg'
            );

        static::assertFileEquals(__DIR__ . '/expected/world-smyth.svg', __DIR__ . '/actual/world-smyth.svg');
    }

    public function testToblersWorldInASquareProjection(): void
    {
        (new GeoSVG(new ToblersWorldInASquareProjection()))
            ->toFile(
                GeometryCollectionFactory::createFromGeoJSONFilePath(dirname(__DIR__, 2) . '/vendor/prinsfrank/natural-earth-vector-geojson-only/geojson/ne_110m_admin_0_countries.geojson'),
                __DIR__ . '/actual/world-toblers-world-in-a-square.svg'
            );

        static::assertFileEquals(__DIR__ . '/expected/world-toblers-world-in-a-square.svg', __DIR__ . '/actual/world-toblers-world-in-a-square.svg');
    }

    public function testTrystanEdwardsProjection(): void
    {
        (new GeoSVG(new TrystanEdwardsProjection()))
            ->toFile(
                GeometryCollectionFactory::createFromGeoJSONFilePath(dirname(__DIR__, 2) . '/vendor/prinsfrank/natural-earth-vector-geojson-only/geojson/ne_110m_admin_0_countries.geojson'),
                __DIR__ . '/actual/world-trystan-edwards.svg'
            );

        static::assertFileEquals(__DIR__ . '/expected/world-trystan-edwards.svg', __DIR__ . '/actual/world-trystan-edwards.svg');
    }
}
