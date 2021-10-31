<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Geometry\BoundingBox;

use PrinsFrank\PhpGeoSVG\Exception\InvalidBoundingBoxPositionException;

/**
 * When crossing the 180th meridian with a bounding box, the bounding box wraps resulting in otherwise invalid coordinates.
 * This class purposefully doesn't extend the default position class as otherwise this class could be used in parameters for the position class.
 */
class BoundingBoxPosition
{
    public const MIN_LONGITUDE = -360;
    public const MAX_LONGITUDE = 360;

    public const MIN_LATITUDE = -90;
    public const MAX_LATITUDE = 90;

    /**
     * @throws InvalidBoundingBoxPositionException
     */
    public function __construct(public float $longitude, public float $latitude)
    {
        if ($this->longitude > static::MAX_LONGITUDE || $this->longitude < static::MIN_LONGITUDE) {
            throw new InvalidBoundingBoxPositionException('The longitude should be between ' . static::MIN_LONGITUDE . ' and ' . static::MAX_LONGITUDE . ', "' . $this->longitude . '" provided.');
        }

        if ($this->latitude > static::MAX_LATITUDE || $this->latitude < static::MIN_LATITUDE) {
            throw new InvalidBoundingBoxPositionException('The latitude should be between ' . static::MIN_LATITUDE . ' and ' . static::MAX_LATITUDE . ', "' . $this->latitude . '" provided.');
        }
    }
}
