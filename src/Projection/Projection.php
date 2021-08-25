<?php

namespace PrinsFrank\PhpGeoSVG\Projection;

interface Projection
{
    /** @return float[] */
    public function project(float $longitude, float $latitude): array;
}
