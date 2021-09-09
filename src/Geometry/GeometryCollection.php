<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Geometry;

use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\GeometryObject;

class GeometryCollection
{
    /** @var GeometryObject[] */
    protected array $geometryObjects;

    public function addGeometryObject(GeometryObject $geometryObject): self
    {
        $this->geometryObjects[] = $geometryObject;

        return $this;
    }
}