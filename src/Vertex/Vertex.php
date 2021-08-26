<?php

namespace PrinsFrank\PhpGeoSVG\Vertex;

use RuntimeException;

class Vertex
{
    public const MIN_LONGITUDE = -180;
    public const MAX_LONGITUDE = 180;

    public const MIN_LATITUDE  = -90;
    public const MAX_LATITUDE  = 90;

    public function __construct(public float $longitude, public float $latitude)
    {
        if (abs($this->longitude) > self::MAX_LONGITUDE) {
            throw new RuntimeException('The latitude should be between ' . self::MIN_LONGITUDE . ' and ' . self::MAX_LONGITUDE);
        }

        if (abs($this->latitude) > self::MAX_LATITUDE) {
            throw new RuntimeException('The longitude should be between ' . self::MIN_LATITUDE . ' and ' . self::MAX_LATITUDE);
        }
    }
}
