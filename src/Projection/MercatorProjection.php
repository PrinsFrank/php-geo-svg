<?php

namespace PrinsFrank\PhpGeoSVG\Projection;

use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;

class MercatorProjection implements Projection
{
    public function getX(Position $position): float
    {
        return ($position->longitude + 180) * ($this->getMaxX() / 360);
    }

    public function getY(Position $position): float
    {
        $latitude = $position->latitude;
        if ($latitude > Position::MAX_LATITUDE - 0.001) {
            $latitude = Position::MAX_LATITUDE - 0.001;
        }

        if ($latitude < Position::MIN_LATITUDE + 0.001) {
            $latitude = Position::MIN_LATITUDE + 0.001;
        }

        return ($this->getMaxY() / 2) - ($this->getMaxX() * log(tan((M_PI / 4) + (($latitude*M_PI / 180) / 2))) / (2 * M_PI));
    }

    public function getMaxX(): float
    {
        return Position::TOTAL_LONGITUDE * .5;
    }

    public function getMaxY(): float
    {
        return Position::TOTAL_LATITUDE;
    }
}
