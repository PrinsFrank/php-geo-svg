<?php

namespace PrinsFrank\PhpGeoSVG\Viewbox;

use PrinsFrank\PhpGeoSVG\Exception\ViewBoxOutOfBoundsException;
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

    public function setMinLongitude(float $minLongitude): self
    {
        $this->minLongitude = $minLongitude;

        return $this;
    }

    public function setMaxLongitude(float $maxLongitude): self
    {
        $this->maxLongitude = $maxLongitude;

        return $this;
    }

    /**
     * @throws ViewBoxOutOfBoundsException
     */
    public function setMinLatitude(float $minLatitude): self
    {
        if ($minLatitude > Vertex::MAX_LATITUDE) {
            throw new ViewBoxOutOfBoundsException('The view box is unnecessarily rotated. Use a minLongitude of "' . (($minLatitude + 180) % 360 - 180) . '" instead to achieve the same view.');
        }

        $this->minLatitude = $minLatitude;

        return $this;
    }

    /**
     * @throws ViewBoxOutOfBoundsException
     */
    public function setMaxLatitude(float $maxLatitude): self
    {
        if ($maxLatitude < Vertex::MIN_LATITUDE) {
            throw new ViewBoxOutOfBoundsException('The view box is unnecessarily rotated. Use a maxLongitude of "' . (($maxLatitude - 180) % 360 + 180) . '" instead to achieve the same view.');
        }

        $this->maxLatitude = $maxLatitude;

        return $this;
    }
}
