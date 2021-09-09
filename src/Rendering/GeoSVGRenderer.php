<?php

namespace PrinsFrank\PhpGeoSVG;

use PrinsFrank\PhpGeoSVG\PolygonSet\PolygonSet;
use PrinsFrank\PhpGeoSVG\PolygonSet\PolygonSetRenderer;
use PrinsFrank\PhpGeoSVG\Projection\Projection;

class GeoSVGRenderer
{
    public const XMLNS   = 'http://www.w3.org/2000/svg';
    public const VERSION = '1.1';

    public function __construct(private GeoSVG $geoSVG) { }

    public function render(Projection $projection): string
    {
        return
            '<svg ' .
                'xmlns="' . self::XMLNS . '" ' .
                'version="' . self::VERSION . '" ' .
                'width="360" ' .
                'height="180" ' .
                'preserveAspectRatio="xMidYMid slice"' .
                'viewBox="' . $this->geoSVG->viewbox->getMinX()
                    . ' ' . $this->geoSVG->viewbox->getMinY()
                    . ' ' . $this->geoSVG->viewbox->getWidth()
                    . ' ' . $this->geoSVG->viewbox->getHeight()
                . '">'. PHP_EOL .
                '<g class="countries">' . PHP_EOL .
                    implode(PHP_EOL, array_map(static function (PolygonSet $multiPolygon) use ($projection) {
                        return PolygonSetRenderer::render($multiPolygon, $projection);
                    }, $this->geoSVG->multiPolygons)) . PHP_EOL .
                '</g>' . PHP_EOL .
            '</svg>'
        ;
    }
}
