<?php

namespace PrinsFrank\PhpGeoSVG;

use PrinsFrank\PhpGeoSVG\Polygon\Polygon;
use PrinsFrank\PhpGeoSVG\Viewbox\ViewBox;

class GeoSVG
{
    public ?Viewbox $viewbox;

    /** @var array<Polygon> */
    public array $polygons;

    public function __construct()
    {
        $this->viewbox = (new ViewBox());
    }

    public function addPolygon(Polygon $polygon): self
    {
        $this->polygons[] = $polygon;

        return $this;
    }
}
