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
        (new GeoSVG(new EquiRectangularProjection(), new BoundingBox(new BoundingBoxPosition(3.5, 50.8), new BoundingBoxPosition(7.2, 53.5))))
            ->setScale(new Scale(20))
            ->toFile(
                GeometryCollectionFactory::createFromGeoJSONFilePath(__DIR__ . '/geojson/netherlands.geojson'),
                __DIR__ . '/actual/netherlands-equirectangular.svg'
            );

        static::assertFileEquals(__DIR__ . '/expected/netherlands-equirectangular.svg', __DIR__ . '/actual/netherlands-equirectangular.svg');
    }

    public function testMercatorProjection(): void
    {
        (new GeoSVG(new MercatorProjection(), new BoundingBox(new BoundingBoxPosition(3.5, 50.8), new BoundingBoxPosition(7.2, 53.5))))
            ->setScale(new Scale(20))
            ->toFile(
                GeometryCollectionFactory::createFromGeoJSONFilePath(__DIR__ . '/geojson/netherlands.geojson'),
                __DIR__ . '/actual/netherlands-mercator.svg'
            );

        static::assertFileEquals(__DIR__ . '/expected/netherlands-mercator.svg', __DIR__ . '/actual/netherlands-mercator.svg');
    }

    public function testMillerProjection(): void
    {
        (new GeoSVG(new MillerProjection(), new BoundingBox(new BoundingBoxPosition(3.5, 50.8), new BoundingBoxPosition(7.2, 53.5))))
            ->setScale(new Scale(20))
            ->toFile(
                GeometryCollectionFactory::createFromGeoJSONFilePath(__DIR__ . '/geojson/netherlands.geojson'),
                __DIR__ . '/actual/netherlands-miller.svg'
            );

        static::assertFileEquals(__DIR__ . '/expected/netherlands-miller.svg', __DIR__ . '/actual/netherlands-miller.svg');
    }
}
