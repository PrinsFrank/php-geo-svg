<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Geometry\GeometryObject;

class MultiLineString extends GeometryObject
{
    /** @var LineString[] */
    protected array $lineStrings = [];

    public function addLineString(LineString $lineString): self
    {
        $this->lineStrings[] = $lineString;

        return $this;
    }

    /**
     * @return LineString[]
     */
    public function getLineStrings(): array
    {
        return $this->lineStrings;
    }
}
