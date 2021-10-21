<?php

namespace PrinsFrank\PhpGeoSVG\Tests\Feature;

use JsonException;
use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Exception\InvalidPositionException;
use PrinsFrank\PhpGeoSVG\Exception\NotImplementedException;
use PrinsFrank\PhpGeoSVG\Exception\PhpGeoSVGException;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryCollection;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryCollectionFactory;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\LineString;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiPolygon;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\Polygon;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;
use PrinsFrank\PhpGeoSVG\GeoSVG;

class WorldMapTest extends TestCase
{
    private const GEO_JSON_FOLDER = 'vendor/prinsfrank/natural-earth-vector-geojson-only/geojson/';

    /**
     * @throws PhpGeoSVGException
     * @throws InvalidPositionException
     */
    public function testSimplifiedWorldMap(): void
    {
        $baseFileName = 'simplified-world-map';
        (new GeoSVG())
            ->toFile(
                (new GeometryCollection())
                    ->addGeometryObject(
                        (new MultiPolygon())
                            ->addPolygon(
                                new Polygon(
                                    (new LineString())
                                        ->addPosition(new Position(-177, 74))
                                        ->addPosition(new Position(-80, 9))
                                        ->addPosition(new Position(-25, 82))
                                        ->setFeatureClass('Continent')
                                )
                            )
                            ->addPolygon(
                                new Polygon(
                                    (new LineString())
                                        ->addPosition(new Position(-80, 9))
                                        ->addPosition(new Position(-37, -7))
                                        ->addPosition(new Position(-70, -55))
                                        ->setFeatureClass('Continent')
                                )
                            )
                            ->addPolygon(
                                new Polygon(
                                    (new LineString())
                                        ->addPosition(new Position(-12, 36))
                                        ->addPosition(new Position(30, 37))
                                        ->addPosition(new Position(27, 70))
                                        ->addPosition(new Position(-24, 66))
                                        ->setFeatureClass('Continent')
                                )
                            )
                            ->addPolygon(
                                new Polygon(
                                    (new LineString())
                                        ->addPosition(new Position(-12, 36))
                                        ->addPosition(new Position(30, 37))
                                        ->addPosition(new Position(51, 11))
                                        ->addPosition(new Position(22, -35))
                                        ->addPosition(new Position(-17, 17))
                                        ->setFeatureClass('Continent')
                                )
                            )
                            ->addPolygon(
                                new Polygon(
                                    (new LineString())
                                        ->addPosition(new Position(27, 70))
                                        ->addPosition(new Position(30, 37))
                                        ->addPosition(new Position(51, 11))
                                        ->addPosition(new Position(131, -2))
                                        ->addPosition(new Position(171, 67))
                                        ->setFeatureClass('Continent')
                                )
                            )
                            ->addPolygon(
                                new Polygon(
                                    (new LineString())
                                        ->addPosition(new Position(115, -15))
                                        ->addPosition(new Position(153, -15))
                                        ->addPosition(new Position(148, -43))
                                        ->addPosition(new Position(114, -35))
                                        ->setFeatureClass('Continent')
                                )
                            )
                    ),
                __DIR__ . '/actual/' . $baseFileName . '.svg'
            );

        self::assertFileEquals(__DIR__ . '/expected/' . $baseFileName . '.svg', __DIR__ . '/actual/' . $baseFileName . '.svg');
    }

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
