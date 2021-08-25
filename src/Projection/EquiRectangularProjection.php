<?php

namespace PrinsFrank\PhpGeoSVG\Projection;

class EquiRectangularProjection implements Projection
{
    /** @return float[] */
    public function project(float $longitude, float $latitude): array
    {
        return [$longitude, $latitude];
    }
}
