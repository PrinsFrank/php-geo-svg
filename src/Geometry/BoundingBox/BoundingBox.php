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
    }
}