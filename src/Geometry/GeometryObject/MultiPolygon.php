<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Geometry\GeometryObject;

class MultiPolygon extends GeometryObject
{
    /** @var Polygon[] */
    protected array $polygons;

    public function addPolygon(Polygon $polygon): self
    {
        $this->polygons[] = $polygon;

        return $this;
    }

    /**
     * @return Polygon[]
     */
    public function getPolygons(): array
    {
        return $this->polygons;
    }
}