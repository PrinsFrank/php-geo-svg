<?php

namespace PrinsFrank\PhpGeoSVG;

use PrinsFrank\PhpGeoSVG\PolygonSet\PolygonSet;
use PrinsFrank\PhpGeoSVG\Viewbox\ViewBox;

class GeoSVG
{
    public ?Viewbox $viewbox;

    /** @var array<PolygonSet> */
    public array $multiPolygons;

    public function __construct()
    {
        $this->viewbox = (new ViewBox());
    }

    public function addPolygonSet(PolygonSet $multiPolygon): self
    {
        $this->multiPolygons[] = $multiPolygon;

        return $this;
    }
}
