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
        return $this->maxLongitude - $this->minLongitude;
    }

    public function getHeight(): float
    {
        return $this->maxLatitude - $this->minLatitude;
    }

    public function getMinX(): float
    {
        return $this->minLongitude - Vertex::MIN_LONGITUDE;
    }

    public function getMinY(): float
    {
        return Vertex::MAX_LATITUDE - $this->maxLatitude;
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

    /**
     * @throws ViewBoxOutOfBoundsException
     */
    public function setMinLongitude(float $minLongitude): self
    {
        if ($minLongitude > Vertex::MAX_LONGITUDE) {
            throw new ViewBoxOutOfBoundsException('The view box is unnecessarily rotated. Use a minLongitude of "' . (($minLongitude + 180) % 360 - 180) . '" instead to achieve the same view.');
        }

        $this->minLongitude = $minLongitude;

        return $this;
    }

    /**
     * @throws ViewBoxOutOfBoundsException
     */
    public function setMaxLongitude(float $maxLongitude): self
    {
        if ($maxLongitude < Vertex::MIN_LONGITUDE) {
            throw new ViewBoxOutOfBoundsException('The view box is unnecessarily rotated. Use a maxLongitude of "' . (($maxLongitude - 180) % 360 + 180) . '" instead to achieve the same view.');
        }

        $this->maxLongitude = $maxLongitude;

        return $this;
    }

    /**
     * @throws ViewBoxOutOfBoundsException
     */
    public function setMinLatitude(float $minLatitude): self
    {
        if ($minLatitude < Vertex::MIN_LATITUDE) {
            throw new ViewBoxOutOfBoundsException('The minimum Latitude is "' . Vertex::MIN_LATITUDE . '"');
        }

        $this->minLatitude = $minLatitude;

        return $this;
    }

    /**
     * @throws ViewBoxOutOfBoundsException
     */
    public function setMaxLatitude(float $maxLatitude): self
    {
        if ($maxLatitude > Vertex::MAX_LATITUDE) {
            throw new ViewBoxOutOfBoundsException('The maximum Latitude is "' . Vertex::MIN_LATITUDE . '"');
        }

        $this->maxLatitude = $maxLatitude;

        return $this;
    }
}
