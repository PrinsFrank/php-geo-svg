<?php

namespace PrinsFrank\PhpGeoSVG;

use PrinsFrank\PhpGeoSVG\PolygonSet\PolygonSet;
use PrinsFrank\PhpGeoSVG\Viewbox\ViewBox;

class GeoSVG
{
    /** @var array<PolygonSet> */
    public array $multiPolygons;

    public function __construct(public ?ViewBox $viewbox)
    {
    }

    public function addPolygonSet(PolygonSet $multiPolygon): self
    {
        $this->multiPolygons[] = $multiPolygon;

        return $this;
    }
}
