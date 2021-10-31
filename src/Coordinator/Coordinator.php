<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Coordinator;

use PrinsFrank\PhpGeoSVG\Geometry\BoundingBox\BoundingBox;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;
use PrinsFrank\PhpGeoSVG\Projection\Projection;
use PrinsFrank\PhpGeoSVG\Scale\Scale;

class Coordinator
{
    public const BASE_SCALE_FACTOR = 2;

    public function __construct(private Projection $projection, private BoundingBox $boundingBox, private Scale $scale)
    {
    }

    public function getWidth(): float
    {
        return ($this->boundingBox->getWidth() / Position::TOTAL_LONGITUDE * $this->projection->getMaxX()) * $this->scale->getFactorX() * self::BASE_SCALE_FACTOR;
    }

    public function getHeight(): float
    {
        return ($this->boundingBox->getHeight() / Position::TOTAL_LATITUDE * $this->projection->getMaxY()) * $this->scale->getFactorY() * self::BASE_SCALE_FACTOR;
    }

    public function getX(Position $position): float
    {
        return $this->boundingBox->boundX($position, $this->projection) * $this->scale->getFactorX() * self::BASE_SCALE_FACTOR;
    }

    public function getY(Position $position): float
    {
        return $this->boundingBox->boundY($position, $this->projection) * $this->scale->getFactorY() * self::BASE_SCALE_FACTOR;
    }
}
