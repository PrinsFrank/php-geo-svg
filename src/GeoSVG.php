<?php

namespace PrinsFrank\PhpGeoSVG;

use PrinsFrank\PhpGeoSVG\MultiPolygon\MultiPolygon;
use PrinsFrank\PhpGeoSVG\Viewbox\ViewBox;

class GeoSVG
{
    public ?Viewbox $viewbox;

    /** @var array<MultiPolygon> */
    public array $multiPolygons;

    public function __construct()
    {
        $this->viewbox = (new ViewBox());
    }

    public function addMultiPolygon(MultiPolygon $multiPolygon): self
    {
        $this->multiPolygons[] = $multiPolygon;

        return $this;
    }
}
