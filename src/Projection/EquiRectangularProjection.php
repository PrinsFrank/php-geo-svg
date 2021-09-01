<?php

namespace PrinsFrank\PhpGeoSVG\Projection;

use PrinsFrank\PhpGeoSVG\Viewbox\ViewBox;

class EquiRectangularProjection implements Projection
{
    public function __construct(private ViewBox $viewBox) { }

    public function getX(float $longitude, float $latitude): float
    {
        return $longitude - $this->viewBox->getMinLongitude();
    }

    public function getY(float $longitude, float $latitude): float
    {
        return - $latitude - $this->viewBox->getMinLatitude();
    }

    public function getMaxX(): float
    {
        return $this->viewBox->getMaxLongitude() - $this->viewBox->getMinLongitude();
    }

    public function getMaxY(): float
    {
        return $this->viewBox->getMaxLatitude() - $this->viewBox->getMinLatitude();
    }
}
