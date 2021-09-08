<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Geometry\GeometryObject;

class Polygon implements GeometryObject
{
    protected LineString $exteriorRing;

    /** @var LineString[] */
    protected array $interiorRings;
}