<?php

namespace PrinsFrank\PhpGeoSVG\Projection;

use PrinsFrank\PhpGeoSVG\Vertex\Vertex;
use PrinsFrank\PhpGeoSVG\Viewbox\ViewBox;

class MercatorProjection implements Projection
{
    public function __construct(private ViewBox $viewBox) { }

    public function getX(float $longitude, float $latitude): float
    {
        return ($longitude+180)*($this->getMaxX()/360);
    }

    public function getY(float $longitude, float $latitude): float
    {
        if ($latitude > Vertex::MAX_LATITUDE - 0.001) {
            $latitude = Vertex::MAX_LATITUDE - 0.001;
        }

        if ($latitude < Vertex::MIN_LATITUDE + 0.001) {
            $latitude = Vertex::MIN_LATITUDE + 0.001;
        }

        return ($this->getMaxY()/2)-($this->getMaxX()*log(tan((M_PI/4)+(($latitude*M_PI/180)/2)))/(2*M_PI));
    }

    public function getMaxX(): float
    {
        return $this->viewBox->getWidth() * .5;
    }

    public function getMaxY(): float
    {
        return $this->viewBox->getHeight();
    }
}
