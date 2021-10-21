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
        $geoJsonFileNames = scandir(dirname(__DIR__, 2) .  '/' .self::GEO_JSON_FOLDER);
        $geoJsonFileNames = array_filter($geoJsonFileNames, static function ($geoJsonFileName){
            return str_contains($geoJsonFileName, '110m');
        });

        static::assertCount(32, $geoJsonFileNames);
        foreach ($geoJsonFileNames as $geoJsonFileName) {
            $baseFileName = substr($geoJsonFileName, 0, -8);
            (new GeoSVG())
                ->toFile(
                    GeometryCollectionFactory::createFromGeoJSONFilePath(self::GEO_JSON_FOLDER . '/' . $geoJsonFileName),
                    __DIR__ . '/actual/' . $baseFileName . '.svg'
                );

            self::assertFileEquals(__DIR__ . '/expected/' . $baseFileName . '.svg', __DIR__ . '/actual/' . $baseFileName . '.svg');
        }
    }
}
