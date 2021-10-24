<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Feature;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Geometry\BoundingBox\BoundingBox;
use PrinsFrank\PhpGeoSVG\Geometry\BoundingBox\BoundingBoxPosition;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryCollectionFactory;
use PrinsFrank\PhpGeoSVG\GeoSVG;
use PrinsFrank\PhpGeoSVG\Scale\Scale;

/**
 * @coversNothing
 */
class GeoSVGWithBoundingBoxTest extends TestCase
{
    public function testGeoSVGWithBoundingBoxNetherlandsTest(): void
    {
        (new GeoSVG(null, new BoundingBox(new BoundingBoxPosition( 3.5, 50.8), new BoundingBoxPosition( 7.2, 53.5))))
            ->setScale(new Scale(10))
            ->toFile(
                GeometryCollectionFactory::createFromGeoJSONFilePath(__DIR__ . '/geojson/netherlands.geojson'),
                __DIR__ . '/actual/bounding-box-netherlands.svg'
            );

        self::assertFileEquals(__DIR__ . '/expected/bounding-box-netherlands.svg', __DIR__ . '/actual/bounding-box-netherlands.svg');
    }
}
