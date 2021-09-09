<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Geometry\GeometryObject;

class MultiLineString implements GeometryObject
{
    /** @var LineString[] */
    protected array $lineStrings;

    public function addLineString(LineString $lineString): self
    {
        $this->lineStrings[] = $lineString;

        return $this;
    }
}