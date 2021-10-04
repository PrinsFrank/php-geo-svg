<?php

namespace PrinsFrank\PhpGeoSVG\Projection;

use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;

class EquiRectangularProjection implements Projection
{
    public function getX(Position $position): float
    {
        return $position->longitude - Position::MIN_LONGITUDE;
    }

    public function getY(Position $position): float
    {
        return - $position->latitude - Position::MIN_LATITUDE;
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
