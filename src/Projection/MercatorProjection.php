<?php

namespace PrinsFrank\PhpGeoSVG\Projection;

use PrinsFrank\PhpGeoSVG\Viewbox\ViewBox;

class MercatorProjection implements Projection
{
    public function __construct(private ViewBox $viewBox) { }

    /** @return float[] */
    public function project(float $longitude, float $latitude): array
    {
        return [
            ($longitude+180)*($this->viewBox->getWidth()/360),
            ($this->viewBox->getHeight()/2)-($this->viewBox->getWidth()*log(tan((M_PI/4)+(($latitude*M_PI/180)/2)))/(2*M_PI))
        ];
    }
}