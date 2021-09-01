<?php

namespace PrinsFrank\PhpGeoSVG\GeoJSON;

use JsonException;
use PrinsFrank\PhpGeoSVG\GeoSVG;
use PrinsFrank\PhpGeoSVG\PolygonSet\PolygonSet;
use PrinsFrank\PhpGeoSVG\Polygon\Polygon;
use PrinsFrank\PhpGeoSVG\Vertex\Vertex;

class GeoJSONParser
{
    /**
     * @throws JsonException
     */
    public static function getPolygons(String $geoJSON): GeoSVG
    {
        $GeoSVG = new GeoSVG();
        $GeoJSON = json_decode($geoJSON, true, 512, JSON_THROW_ON_ERROR);
        foreach($GeoJSON['features'] as $feature) {
            foreach ($feature['geometry']['type'] === 'Polygon' ? [$feature['geometry']['coordinates']] : $feature['geometry']['coordinates'] as $territories) {
                $multiPolygon = new PolygonSet($feature['properties']['NAME']);
                foreach($territories as $territory) {
                    $polygon = new Polygon();
                    foreach($territory as $coordinates) {
                        $polygon->addVertex(new Vertex($coordinates[0], $coordinates[1]));
                    }
                    $multiPolygon->addPolygon($polygon);
                }
                $GeoSVG->addPolygonSet($multiPolygon);
            }
        }

        return $GeoSVG;
    }
}
