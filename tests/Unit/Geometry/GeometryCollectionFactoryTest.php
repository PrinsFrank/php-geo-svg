<?php
declare(strict_types=1);

namespace Geometry;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Exception\NotImplementedException;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryCollection;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryCollectionFactory;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiLineString;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Geometry\GeometryCollectionFactory
 */
class GeometryCollectionFactoryTest extends TestCase
{
    /**
     * @covers ::createFromGeoJSONArray
     */
    public function testCreateFromGeoJSONArrayThrowsExceptionWhenSomethingElseThenFeatureCollectionIsProvided(): void
    {
        $this->expectException(NotImplementedException::class);
        $this->expectExceptionMessage('Only FeatureCollections are currently supported');

        GeometryCollectionFactory::createFromGeoJSONArray(['type' => 'foo']);
    }

    /**
     * @covers ::createFromGeoJSONArray
     */
    public function testCreateFromGeoJSONArrayThrowsExceptionWhenTypeOfFeatureIsNotFeature(): void
    {
        $this->expectException(NotImplementedException::class);
        $this->expectExceptionMessage('Only features of type "Feature" are supported.');

        GeometryCollectionFactory::createFromGeoJSONArray(['type' => 'FeatureCollection', 'features' => [['type' => 'foo']]]);
    }

    /**
     * @covers ::createFromGeoJSONArray
     */
    public function testIgnoresEmptyGeometryObjects(): void
    {
        static::assertEquals(
            new GeometryCollection(),
            GeometryCollectionFactory::createFromGeoJSONArray(
                [
                    'type'     => 'FeatureCollection',
                    'features' => [
                        [
                            'type' => 'Feature',
                            'geometry' => [
                                'type' => 'Polygon',
                                'coordinates' => []
                            ]
                        ]
                    ]
                ]
            )
        );
    }

    /**
     * @covers ::createFromGeoJSONArray
     */
    public function testCreatesFromGeoJSONArray(): void
    {
        static::assertEquals(
            (new GeometryCollection())
                ->addGeometryObject(new MultiLineString()),
            GeometryCollectionFactory::createFromGeoJSONArray(
                [
                    'type'     => 'FeatureCollection',
                    'features' => [
                        [
                            'type' => 'Feature',
                            'geometry' => [
                                'type' => 'MultiLineString',
                                'coordinates' => []
                            ]
                        ]
                    ]
                ]
            )
        );
    }

    /**
     * @covers ::createFromGeoJSONArray
     */
    public function testCreatesFromGeoJSONArraySetsFeatureCla(): void
    {
        static::assertEquals(
            (new GeometryCollection())
                ->addGeometryObject(
                    (new MultiLineString())
                    ->setProperties(['featurecla' => 'bar'])
                    ->setFeatureClass('bar')
                ),
            GeometryCollectionFactory::createFromGeoJSONArray(
                [
                    'type'     => 'FeatureCollection',
                    'features' => [
                        [
                            'type' => 'Feature',
                            'properties' => [
                                'featurecla' => 'bar'
                            ],
                            'geometry' => [
                                'type' => 'MultiLineString',
                                'coordinates' => []
                            ]
                        ]
                    ]
                ]
            )
        );
    }

    /**
     * @covers ::createFromGeoJsonString
     */
    public function testCreateFromGeoJsonString(): void
    {
        static::assertEquals(
            (new GeometryCollection())
                ->addGeometryObject(
                    (new MultiLineString())
                        ->setProperties(['featurecla' => 'bar'])
                        ->setFeatureClass('bar')
                ),
            GeometryCollectionFactory::createFromGeoJsonString('{"type":"FeatureCollection","features":[{"type":"Feature","properties":{"featurecla":"bar"},"geometry":{"type":"MultiLineString","coordinates":[]}}]}')
        );
    }

    /**
     * @covers ::createFromGeoJSONFilePath
     */
    public function testCreateFromGeoJsonFilePath(): void
    {
        static::assertEquals(
            (new GeometryCollection())
                ->addGeometryObject(
                    (new MultiLineString())
                        ->setProperties(['featurecla' => 'bar'])
                        ->setFeatureClass('bar')
                ),
            GeometryCollectionFactory::createFromGeoJSONFilePath(__DIR__ . '/geometry_collection_factory_test.geojson')
        );
    }
}
