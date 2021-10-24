<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Geometry\BoundingBox;

use PrinsFrank\PhpGeoSVG\Exception\InvalidBoundingBoxException;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;
use PrinsFrank\PhpGeoSVG\Projection\Projection;

class BoundingBox
{
    /**
     * @throws InvalidBoundingBoxException
     */
    public function __construct(public BoundingBoxPosition $southWestern, public BoundingBoxPosition $northEastern)
    {
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

        if ($this->northEastern->latitude < $this->southWestern->latitude) {
            throw new InvalidBoundingBoxException(
                'The latitude of the NorthEastern coordinate (' . $this->northEastern->latitude . ') is south of the SouthWestern coordinate (' . $this->southWestern->latitude . ')'
            );
        }

        if ($this->northEastern->longitude < $this->southWestern->longitude) {
            throw new InvalidBoundingBoxException(
                'The longitude of the NorthEastern coordinate (' . $this->northEastern->longitude . ') is west of the SouthWestern coordinate (' . $this->southWestern->longitude . ')'
            );
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

    public function boundX(Position $position, Projection $projection): float
    {
        return $projection->getX($position)
            - ($projection->getX(new Position($this->southWestern->longitude, 0))
            - $projection->getX(new Position(Position::MIN_LONGITUDE, 0)));
    }

    public function boundY(Position $position, Projection $projection): float
    {
        return $projection->getY($position)
            - ($projection->getY(new Position(0, $this->northEastern->latitude)));
    }
}