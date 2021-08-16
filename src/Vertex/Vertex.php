<?php

namespace PrinsFrank\PhpGeoSVG\Vertex;

use RuntimeException;

class Vertex
{
    public const MIN_LONGITUDE = -90;
    public const MAX_LONGITUDE = 90;

    public const MIN_LATITUDE  = -180;
    public const MAX_LATITUDE  = 180;

    public function __construct(public float $latitude, public float $longitude)
    {
        if (abs($this->longitude) > 90) {
            throw new RuntimeException('The latitude should be between -90 and 90');
        }

        if (abs($this->latitude) > 180) {
            throw new RuntimeException('The longitude should be between -180 and 180');
        }
    }
}
