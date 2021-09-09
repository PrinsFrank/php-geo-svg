<?php

namespace PrinsFrank\PhpGeoSVG\GeoJSON;

use JsonException;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryCollection;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\LineString;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiPolygon;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\Polygon;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;

class GeoJSONParser
{
    /**
     * @throws JsonException
     */
    public static function getPolygons(String $geoJSON): GeometryCollection
    {
        $geometryCollection = new GeometryCollection();
        $GeoJSON = json_decode($geoJSON, true, 512, JSON_THROW_ON_ERROR);
        foreach($GeoJSON['features'] as $feature) {
            foreach ($feature['geometry']['type'] === 'Polygon' ? [$feature['geometry']['coordinates']] : $feature['geometry']['coordinates'] as $territories) {
                $multiPolygon = new MultiPolygon($feature['properties']['NAME']);
                foreach($territories as $territory) {
                    $exteriorRing = new LineString();
                    foreach($territory as $coordinates) {
                        $exteriorRing->addPosition(new Position($coordinates[0], $coordinates[1]));
                    }
                    $multiPolygon->addPolygon(new Polygon($exteriorRing));
                }
                $geometryCollection->addGeometryObject($multiPolygon);
            }
        }

        return $geometryCollection;
    }
}
