<?php

namespace PrinsFrank\PhpGeoSVG\MultiPolygon;

use PrinsFrank\PhpGeoSVG\Polygon\Polygon;

class MultiPolygon
{
    public function __construct(public ?string $title = null) { }

    public array $polygons;

    public function addPolygon(Polygon $polygon): self
    {
        $this->polygons[] = $polygon;

        return $this;
    }
}
