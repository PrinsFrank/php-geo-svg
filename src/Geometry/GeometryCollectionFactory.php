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
    public static function createFromGeoJSONArray(array $geoJSONArray, GeometryObjectCallback $geometryObjectCallback = null): GeometryCollection
    {
        $geometryCollection = new GeometryCollection();

        if(!is_null($geometryObjectCallback)) {
            $geometryCollection->setGeometryObjectCallback($geometryObjectCallback);
        }

        if ('FeatureCollection' !== $geoJSONArray['type']) {
            throw new NotImplementedException('Only FeatureCollections are currently supported');
        }

        foreach ($geoJSONArray['features'] ?? [] as $feature) {
            if ('Feature' !== $feature['type']) {
                throw new NotImplementedException('Only features of type "Feature" are supported.');
            }

            $geometryObject = GeometryObjectFactory::createForGeoJsonFeatureGeometry($feature['geometry']);
            if (null === $geometryObject) {
                continue;
            }

            if (array_key_exists('properties', $feature) && array_key_exists('featurecla', $feature['properties'])) {
                $geometryObject->setFeatureClass($feature['properties']['featurecla']);
            }

            if(array_key_exists('properties', $feature) && !empty($feature['properties'])) {
                $geometryObject->setProperties($feature['properties']);
            }

            $geometryCollection->addGeometryObject($geometryObject);
        }

        return $geometryCollection;
    }

    /**
     * @throws JsonException|NotImplementedException|InvalidPositionException
     */
    public static function createFromGeoJsonString(string $geoJsonString, GeometryObjectCallback $geometryObjectCallback = null): GeometryCollection
    {
        return self::createFromGeoJSONArray(json_decode($geoJsonString, true, 512, JSON_THROW_ON_ERROR), $geometryObjectCallback);
    }

    /**
     * @throws JsonException|NotImplementedException|InvalidPositionException
     */
    public static function createFromGeoJSONFilePath(string $path, GeometryObjectCallback $geometryObjectCallback = null): GeometryCollection
    {
        return self::createFromGeoJsonString(file_get_contents($path), $geometryObjectCallback);
    }
}
