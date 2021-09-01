<?php

namespace PrinsFrank\PhpGeoSVG\PolygonSet;

use PrinsFrank\PhpGeoSVG\Polygon\Polygon;

class PolygonSet
{
    public function __construct(public ?string $title = null) { }

    public array $polygons;

    public function addPolygon(Polygon $polygon): self
    {
        $this->polygons[] = $polygon;

        return $this;
    }
}
