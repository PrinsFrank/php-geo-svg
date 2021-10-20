<?php

namespace PrinsFrank\PhpGeoSVG\Tests\Feature;

use JsonException;
use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Exception\InvalidPositionException;
use PrinsFrank\PhpGeoSVG\Exception\NotImplementedException;
use PrinsFrank\PhpGeoSVG\Exception\PhpGeoSVGException;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryCollectionFactory;
use PrinsFrank\PhpGeoSVG\GeoSVG;

class WorldMapTest extends TestCase
{
    private const GEO_JSON_FOLDER = 'vendor/prinsfrank/natural-earth-vector-geojson-only/geojson/';

    /**
     * @throws InvalidPositionException
     * @throws PhpGeoSVGException
     * @throws NotImplementedException
     * @throws JsonException
     */
    public function testGeneratesFromGeoJson(): void
    {
        $testName = 'generated-from-geojson';

        (new GeoSVG())
            ->toFile(
                GeometryCollectionFactory::createFromGeoJSONFilePath(self::GEO_JSON_FOLDER . '/ne_110m_admin_0_countries.geojson'),
                __DIR__ . '/actual/' . $testName . '.svg'
            );

        self::assertFileEquals(__DIR__ . '/expected/' . $testName . '.svg', __DIR__ . '/actual/' . $testName . '.svg');
    }

    /**
     * @throws InvalidPositionException
     * @throws PhpGeoSVGException
     * @throws NotImplementedException
     * @throws JsonException
     */
    public function testSupportsAllGeoJsonFilesInNaturalEarthVectorSet(): void
    {
        $geoJsonFileNames = scandir(dirname(__DIR__, 2) .  '/' .self::GEO_JSON_FOLDER);
        $geoJsonFileNames = array_diff($geoJsonFileNames, ['.', '..']);

        static::assertCount(162, $geoJsonFileNames);
        foreach ($geoJsonFileNames as $geoJsonFileName) {
            (new GeoSVG())
                ->render(GeometryCollectionFactory::createFromGeoJSONFilePath(self::GEO_JSON_FOLDER . $geoJsonFileName));
            $this->addToAssertionCount(1);
        }
    }
}
