<?php

namespace PrinsFrank\PhpGeoSVG\MultiPolygon;

use PrinsFrank\PhpGeoSVG\Polygon\Polygon;
use PrinsFrank\PhpGeoSVG\Polygon\PolygonRenderer;
use PrinsFrank\PhpGeoSVG\Projection\Projection;

class MultiPolygonRenderer
{
    public static function render(Projection $projection, MultiPolygon $multiPolygon): string
    {
        return
            '<g>' .
                implode('', array_map(static function(Polygon $polygon) use ($projection) {
                    return PolygonRenderer::render($projection, $polygon);
                }, $multiPolygon->polygons)) .
                '<title>' . $multiPolygon->title . '</title>' . PHP_EOL .
            '</g>'
        ;
    }
}
