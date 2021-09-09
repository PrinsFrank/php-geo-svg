<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Geometry\GeometryObject;

class Polygon implements GeometryObject
{
    protected LineString $exteriorRing;

    /** @var LineString[] elements representing interior rings (or holes) */
    protected array $interiorRings;
}