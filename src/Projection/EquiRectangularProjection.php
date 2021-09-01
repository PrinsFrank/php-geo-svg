<?php

namespace PrinsFrank\PhpGeoSVG\Projection;

use PrinsFrank\PhpGeoSVG\Vertex\Vertex;

class EquiRectangularProjection implements Projection
{
    public function getX(float $longitude, float $latitude): float
    {
        return $longitude - Vertex::MIN_LONGITUDE;
    }

    public function getY(float $longitude, float $latitude): float
    {
        return - $latitude - Vertex::MIN_LATITUDE;
    }

    public function getMaxX(): float
    {
        return Vertex::TOTAL_LONGITUDE;
    }

    public function getMaxY(): float
    {
        return Vertex::TOTAL_LATITUDE;
    }
}
