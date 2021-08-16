<?php

namespace PrinsFrank\PhpGeoSVG\Polygon;

use PrinsFrank\PhpGeoSVG\Vertex\Vertex;

class PolygonRenderer
{
    public static function render(Polygon $polygon): string
    {
        return
            '<path ' .
            'd="M' .
                implode('L', array_map(static function(Vertex $vertex) {
                    return $vertex->latitude . ',' . $vertex->longitude;
                }, $polygon->vertices)) .
            '">' .
            '</path>'
        ;
    }
}
