<?php

namespace PrinsFrank\PhpGeoSVG\Projection;

class MillerProjection extends MercatorProjection
{
    public function getY(float $longitude, float $latitude): float
    {
        return parent::getY($longitude, $latitude) / 5 * 4;
    }
}
