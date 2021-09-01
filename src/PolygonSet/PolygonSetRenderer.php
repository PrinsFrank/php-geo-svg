<?php

namespace PrinsFrank\PhpGeoSVG\PolygonSet;

use PrinsFrank\PhpGeoSVG\Polygon\Polygon;
use PrinsFrank\PhpGeoSVG\Polygon\PolygonRenderer;
use PrinsFrank\PhpGeoSVG\Projection\Projection;

class PolygonSetRenderer
{
    public static function render(Projection $projection, PolygonSet $multiPolygon): string
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
