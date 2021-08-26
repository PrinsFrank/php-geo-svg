<?php

namespace PrinsFrank\PhpGeoSVG\Polygon;

use PrinsFrank\PhpGeoSVG\Projection\Projection;
use PrinsFrank\PhpGeoSVG\Vertex\Vertex;

class PolygonRenderer
{
    public static function render(Projection $projection, Polygon $polygon): string
    {
        return
            '<path ' .
            'd="M' .
                implode('L', array_map(static function(Vertex $vertex) use ($projection) {
                    return $projection->getX($vertex->longitude, $vertex->latitude) . ' ' . $projection->getY($vertex->longitude, $vertex->latitude);
                }, $polygon->vertices)) .
            '">' .
            '</path>'
        ;
    }
}
