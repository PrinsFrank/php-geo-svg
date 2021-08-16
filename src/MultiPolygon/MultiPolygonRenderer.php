<?php

namespace PrinsFrank\PhpGeoSVG\MultiPolygon;

use PrinsFrank\PhpGeoSVG\Polygon\Polygon;
use PrinsFrank\PhpGeoSVG\Polygon\PolygonRenderer;

class MultiPolygonRenderer
{
    public static function render(MultiPolygon $multiPolygon): string
    {
        return
            '<g>' .
                implode('', array_map(static function(Polygon $polygon) {
                    return PolygonRenderer::render($polygon);
                }, $multiPolygon->polygons)) .
                '<title>' . $multiPolygon->title . '</title>' . PHP_EOL .
            '</g>'
        ;
    }
}
