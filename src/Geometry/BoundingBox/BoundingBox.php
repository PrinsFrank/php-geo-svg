<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Geometry\BoundingBox;

use PrinsFrank\PhpGeoSVG\Exception\InvalidBoundingBoxException;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;

class BoundingBox
{
    /**
     * @throws InvalidBoundingBoxException
     */
    public function __construct(public Position $southWestern, public Position $northEastern)
    {
        if ($this->southWestern->hasElevation() !== $this->northEastern->hasElevation()) {
            throw new InvalidBoundingBoxException('Either both or none of the Positions should have an elevation');
        }

        if ($this->southWestern->longitude > Position::MAX_LONGITUDE) {
            throw new InvalidBoundingBoxException(
                'The bounding box is unnecessarily rotated. Use a minLongitude of "' . (($this->southWestern->longitude + 180) % 360 - 180) . '" instead to achieve the same bound.'
            );
        }

        if ($this->northEastern->longitude < Position::MIN_LONGITUDE) {
            throw new InvalidBoundingBoxException(
                'The bounding box is unnecessarily rotated. Use a maxLongitude of "' . (($this->northEastern->longitude - 180) % 360 + 180) . '" instead to achieve the same bound.'
            );
        }

        if ($this->southWestern->latitude < Position::MIN_LATITUDE) {
            throw new InvalidBoundingBoxException('The minimum Latitude is "' . Position::MIN_LATITUDE . '"');
        }

        if ($this->northEastern->latitude > Position::MAX_LATITUDE) {
            throw new InvalidBoundingBoxException('The maximum Latitude is "' . Position::MIN_LATITUDE . '"');
        }
    }

    public function getWidth(): float
    {
        return - $this->southWestern->longitude + $this->northEastern->longitude;
    }

    public function getHeight(): float
    {
        return - $this->southWestern->latitude + $this->northEastern->latitude;
    }

    public function boundX(float $projectedX): float
    {
        return $projectedX;
    }

    public function boundY(float $projectedY): float
    {
        return $projectedY;
    }
}