<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Projection;

use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;

class MercatorProjection implements Projection
{
    public function getX(Position $position): float
    {
        return ($position->longitude + 180) * (Position::TOTAL_LONGITUDE * .5 / 360);
    }

    public function getY(Position $position): float
    {
        $latitude = $position->latitude;
        if ($latitude > $this->getMaxLatitude() - 0.001) {
            $latitude = $this->getMaxLatitude() - 0.001;
        }

        if ($latitude < (-$this->getMaxLatitude()) + 0.001) {
            $latitude = (-$this->getMaxLatitude()) + 0.001;
        }

        return (Position::TOTAL_LATITUDE / 2) - (Position::TOTAL_LONGITUDE * .5 * log(tan((M_PI / 4) + (($latitude*M_PI / 180) / 2))) / (2 * M_PI));
    }

    public function getMaxX(): float
    {
        return Position::TOTAL_LONGITUDE * .5;
    }

    public function getMaxY(): float
    {
        return Position::TOTAL_LATITUDE;
    }

    public function getMaxLatitude(): float
    {
        return 85;
    }
}
