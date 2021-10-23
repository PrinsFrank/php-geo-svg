<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Geometry;

use JsonException;
use PrinsFrank\PhpGeoSVG\Exception\InvalidPositionException;
use PrinsFrank\PhpGeoSVG\Exception\NotImplementedException;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\GeometryObjectFactory;

class GeometryCollectionFactory
{
    /**
     * @throws NotImplementedException|InvalidPositionException
     */
    public static function createFromGeoJSONArray(array $geoJSONArray): GeometryCollection
    {
        $geometryCollection = new GeometryCollection();
        if ($geoJSONArray['type'] !== 'FeatureCollection') {
            throw new NotImplementedException('Only FeatureCollections are currently supported');
        }

        foreach ($geoJSONArray['features'] ?? [] as $feature) {
            if ($feature['type'] !== 'Feature') {
                throw new NotImplementedException('Only features of type "Feature" are supported.');
            }

            $geometryObject = GeometryObjectFactory::createForGeoJsonFeatureGeometry($feature['geometry']);
            if ($geometryObject === null) {
                continue;
            }

            if (array_key_exists('properties', $feature) && array_key_exists('featurecla', $feature['properties'])) {
                $geometryObject->setFeatureClass($feature['properties']['featurecla']);
            }

            $geometryCollection->addGeometryObject($geometryObject);
        }

        return $geometryCollection;
    }

    /**
     * @throws JsonException|NotImplementedException|InvalidPositionException
     */
    public static function createFromGeoJsonString(string $geoJsonString): GeometryCollection
    {
        return self::createFromGeoJSONArray(json_decode($geoJsonString, true, 512, JSON_THROW_ON_ERROR));
    }

    /**
     * @throws JsonException|NotImplementedException|InvalidPositionException
     */
    public static function createFromGeoJSONFilePath(string $path): GeometryCollection
    {
        return self::createFromGeoJsonString(file_get_contents($path));
    }
}