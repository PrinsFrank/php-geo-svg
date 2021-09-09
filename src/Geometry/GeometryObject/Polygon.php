<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Geometry\GeometryObject;

class Polygon implements GeometryObject
{
    /** @var LineString[] elements representing interior rings (or holes) */
    protected array $interiorRings;

    public function __construct(protected LineString $exteriorRing)
    {
    }

    public function addInteriorRing(LineString $lineString): self
    {
        $this->interiorRings[] = $lineString;

        return $this;
    }
}