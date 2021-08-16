<?php

namespace PrinsFrank\PhpGeoSVG\Viewbox;

use PrinsFrank\PhpGeoSVG\Vertex\Vertex;

class ViewBox
{
    private float $minLongitude = Vertex::MIN_LONGITUDE;
    private float $maxLongitude = Vertex::MAX_LONGITUDE;

    private float $minLatitude  = Vertex::MIN_LATITUDE;
    private float $maxLatitude  = Vertex::MAX_LATITUDE;

    public function getWidth(): float
    {
        return $this->maxLatitude - $this->minLatitude;
    }

    public function getHeight(): float
    {
        return $this->maxLongitude - $this->minLongitude;
    }

    public function getMinLatitude(): float
    {
        return $this->minLatitude;
    }

    public function getMinLongitude(): float
    {
        return $this->minLongitude;
    }

    public function getMaxLatitude(): float
    {
        return $this->maxLatitude;
    }

    public function getMaxLongitude(): float
    {
        return $this->maxLongitude;
    }
}
