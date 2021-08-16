<?php

namespace PrinsFrank\PhpGeoSVG;

use PrinsFrank\PhpGeoSVG\Polygon\Polygon;
use PrinsFrank\PhpGeoSVG\Polygon\PolygonRenderer;

class GeoSVGRenderer
{
    public const XMLNS   = 'http://www.w3.org/2000/svg';
    public const VERSION = '1.1';

    public function __construct(private GeoSVG $geoSVG) { }

    public function render(): string
    {
        return
            '<svg ' .
                'xmlns="' . self::XMLNS . '" ' .
                'version="' . self::VERSION . '" ' .
                'width="' . $this->geoSVG->viewbox->getWidth() . '" ' .
                'height="' . $this->geoSVG->viewbox->getHeight() . '" ' .
                'preserveAspectRatio="xMidYMid slice" ' .
                'viewBox="' . $this->geoSVG->viewbox->getMinLatitude() . ' ' . $this->geoSVG->viewbox->getMinLongitude() . ' ' . $this->geoSVG->viewbox->getWidth() . ' ' . $this->geoSVG->viewbox->getHeight() . '">'. PHP_EOL .
                '<g class="countries" transform="matrix(1 0 0 -1 0 0)">' . PHP_EOL .
                    implode(PHP_EOL, array_map(static function (Polygon $polygon) {
                        return PolygonRenderer::render($polygon);
                    }, $this->geoSVG->polygons)) . PHP_EOL .
                '</g>' . PHP_EOL .
            '</svg>'
        ;
    }
}
