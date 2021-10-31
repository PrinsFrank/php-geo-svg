<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Geometry\GeometryObject;

class Polygon extends GeometryObject
{
    /** @var LineString[] elements representing interior rings (or holes) */
    protected array $interiorRings = [];

    public function __construct(protected LineString $exteriorRing)
    {
    }

    public function addInteriorRing(LineString $lineString): self
    {
        $this->interiorRings[] = $lineString;

        return $this;
    }

    public function getExteriorRing(): LineString
    {
        return $this->exteriorRing;
    }

    /**
     * @return LineString[]
     */
    public function getInteriorRings(): array
    {
        return $this->interiorRings;
    }
}
