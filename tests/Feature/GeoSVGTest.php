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

/**
 * @coversNothing
 */
class GeoSVGTest extends TestCase
{
    private const GEO_JSON_FOLDER = 'vendor/prinsfrank/natural-earth-vector-geojson-only/geojson/';

    public function testFromGeoJsonFile(): void
    {
        (new GeoSVG())
            ->toFile(
                GeometryCollectionFactory::createFromGeoJSONFilePath(__DIR__ . '/geojson/continents.geojson'),
                __DIR__ . '/actual/from-geojson-file.svg'
            );

        self::assertFileEquals(__DIR__ . '/expected/from-geojson-file.svg', __DIR__ . '/actual/from-geojson-file.svg');
    }

    /**
     * @throws InvalidPositionException
     * @throws PhpGeoSVGException
     * @throws NotImplementedException
     * @throws JsonException
     */
    public function testGeneratesFromGeoJsonFiles(): void
    {
        $geoJsonFileNames = scandir(dirname(__DIR__, 2) .  '/' . self::GEO_JSON_FOLDER);
        $geoJsonFileNames = array_filter($geoJsonFileNames, static function ($geoJsonFileName){
            return str_contains($geoJsonFileName, '110m');
        });

        static::assertCount(32, $geoJsonFileNames);
        foreach ($geoJsonFileNames as $geoJsonFileName) {
            $baseFileName = substr($geoJsonFileName, 0, -8);
            (new GeoSVG())
                ->toFile(
                    GeometryCollectionFactory::createFromGeoJSONFilePath(self::GEO_JSON_FOLDER . $geoJsonFileName),
                    __DIR__ . '/actual/' . $baseFileName . '.svg'
                );

            self::assertFileEquals(__DIR__ . '/expected/' . $baseFileName . '.svg', __DIR__ . '/actual/' . $baseFileName . '.svg');
        }
    }

    public function testFromGeoJsonString(): void
    {
        (new GeoSVG())
            ->toFile(
                GeometryCollectionFactory::createFromGeoJsonString(
                    '{"type":"FeatureCollection","features":[{"type":"Feature","properties":{"featurecla":"Continent"},"geometry":{"type":"MultiLineString","coordinates":[[[-177,74],[-80,9],[-25,82]]]}},{"type":"Feature","properties":{"featurecla":"Continent"},"geometry":{"type":"MultiLineString","coordinates":[[[-80,9],[-37,-7],[-70,-55]]]}},{"type":"Feature","properties":{"featurecla":"Continent"},"geometry":{"type":"MultiLineString","coordinates":[[[-12,36],[30,37],[27,70],[-24,66]]]}},{"type":"Feature","properties":{"featurecla":"Continent"},"geometry":{"type":"MultiLineString","coordinates":[[[-12,36],[30,37],[51,11],[22,-35],[-17,17]]]}},{"type":"Feature","properties":{"featurecla":"Continent"},"geometry":{"type":"MultiLineString","coordinates":[[[27,70],[30,37],[51,11],[131,-2],[171,67]]]}},{"type":"Feature","properties":{"featurecla":"Continent"},"geometry":{"type":"MultiLineString","coordinates":[[[115,-15],[153,-15],[148,-43],[114,-35]]]}}]}'
                ),
                __DIR__ . '/actual/from-geojson-string.svg'
            );

        self::assertFileEquals(__DIR__ . '/expected/from-geojson-string.svg', __DIR__ . '/actual/from-geojson-string.svg');
    }

    public function testFromGeoJSONArray(): void
    {
        (new GeoSVG())
            ->toFile(
                GeometryCollectionFactory::createFromGeoJSONArray(
                    [
                        'type' => 'FeatureCollection',
                        'features' => [
                            [
                                'type' => 'Feature',
                                'properties' => [
                                    'featurecla' => 'Continent'
                                ],
                                'geometry' => [
                                    'type' => 'MultiLineString',
                                    'coordinates' => [
                                        [
                                            [-177, 74],
                                            [-80, 9],
                                            [-25, 82]
                                        ]
                                    ]
                                ]
                            ],
                            [
                                'type' => 'Feature',
                                'properties' => [
                                    'featurecla' => 'Continent'
                                ],
                                'geometry' => [
                                    'type' => 'MultiLineString',
                                    'coordinates' => [
                                        [
                                            [-80, 9],
                                            [-37, -7],
                                            [-70, -55]
                                        ]
                                    ]
                                ]
                            ],
                            [
                                'type' => 'Feature',
                                'properties' => [
                                    'featurecla' => 'Continent'
                                ],
                                'geometry' => [
                                    'type' => 'MultiLineString',
                                    'coordinates' => [
                                        [
                                            [-12, 36],
                                            [30, 37],
                                            [27, 70],
                                            [-24, 66]
                                        ]
                                    ]
                                ]
                            ],
                            [
                                'type' => 'Feature',
                                'properties' => [
                                    'featurecla' => 'Continent'
                                ],
                                'geometry' => [
                                    'type' => 'MultiLineString',
                                    'coordinates' => [
                                        [
                                            [-12, 36],
                                            [30, 37],
                                            [51, 11],
                                            [22, -35],
                                            [-17, 17]
                                        ]
                                    ]
                                ]
                            ],
                            [
                                'type' => 'Feature',
                                'properties' => [
                                    'featurecla' => 'Continent'
                                ],
                                'geometry' => [
                                    'type' => 'MultiLineString',
                                    'coordinates' => [
                                        [
                                            [27, 70],
                                            [30, 37],
                                            [51, 11],
                                            [131, -2],
                                            [171, 67]
                                        ]
                                    ]
                                ]
                            ],
                            [
                                'type' => 'Feature',
                                'properties' => [
                                    'featurecla' => 'Continent'
                                ],
                                'geometry' => [
                                    'type' => 'MultiLineString',
                                    'coordinates' => [
                                        [
                                            [115, -15],
                                            [153, -15],
                                            [148, -43],
                                            [114, -35]
                                        ]
                                    ]
                                ]
                            ],
                        ]
                    ]
                ),
                __DIR__ . '/actual/from-geojson-array.svg'
            );

        self::assertFileEquals(__DIR__ . '/expected/from-geojson-array.svg', __DIR__ . '/actual/from-geojson-array.svg');
    }

    /**
     * @throws PhpGeoSVGException
     * @throws InvalidPositionException
     */
    public function testFromGeometryCollection(): void
    {
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
                                        ->setTitle('North America')
                                )
                            )
                            ->addPolygon(
                                new Polygon(
                                    (new LineString())
                                        ->addPosition(new Position(-80, 9))
                                        ->addPosition(new Position(-37, -7))
                                        ->addPosition(new Position(-70, -55))
                                        ->setFeatureClass('Continent')
                                        ->setTitle('South America')
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
                                        ->setTitle('Europe')
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
                                        ->setTitle('Africa')
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
                                        ->setTitle('Asia')
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
                                        ->setTitle('Australia')
                                )
                            )
                    ),
                __DIR__ . '/actual/from-geometry-collection.svg'
            );

        self::assertFileEquals(__DIR__ . '/expected/from-geometry-collection.svg', __DIR__ . '/actual/from-geometry-collection.svg');
    }
}
