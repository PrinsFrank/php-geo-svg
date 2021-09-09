<?php

namespace PrinsFrank\PhpGeoSVG\Projection;

use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;

class EquiRectangularProjection implements Projection
{
    public function getX(float $longitude, float $latitude): float
    {
        return $longitude - Position::MIN_LONGITUDE;
    }

    public function getY(float $longitude, float $latitude): float
    {
        return - $latitude - Position::MIN_LATITUDE;
    }

    public function getMaxX(): float
    {
        return Position::TOTAL_LONGITUDE;
    }

    public function getMaxY(): float
    {
        return Position::TOTAL_LATITUDE;
    }
}
