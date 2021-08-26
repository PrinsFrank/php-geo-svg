<?php

namespace PrinsFrank\PhpGeoSVG\Projection;

use PrinsFrank\PhpGeoSVG\Viewbox\ViewBox;

class EquiRectangularProjection implements Projection
{
    public function __construct(private ViewBox $viewBox) { }

    public function getX(float $longitude, float $latitude): float
    {
        return $longitude;
    }

    public function getY(float $longitude, float $latitude): float
    {
        return $latitude;
    }

    public function getMinX(): float
    {
        return $this->viewBox->getMinLongitude();
    }

    public function getMaxX(): float
    {
        return $this->viewBox->getMaxLongitude();
    }

    public function getMinY(): float
    {
        return $this->viewBox->getMinLatitude();
    }

    public function getMaxY(): float
    {
        return $this->viewBox->getMaxLatitude();
    }

    public function getCoordinatesTransformation(): ?string
    {
        return 'matrix(1 0 0 -1 0 0)';
    }
}
