<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Coordinator;

use PrinsFrank\PhpGeoSVG\Geometry\BoundingBox\BoundingBox;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;
use PrinsFrank\PhpGeoSVG\Projection\Projection;

class Coordinator
{
    public function __construct(private Projection $projection, private BoundingBox $boundingBox)
    {
    }

    public function getWidth(): float
    {
        return $this->boundingBox->getWidth() / Position::TOTAL_LONGITUDE * $this->projection->getMaxX();
    }

    public function getHeight(): float
    {
        return $this->boundingBox->getHeight() / Position::TOTAL_LATITUDE * $this->projection->getMaxY();
    }

    public function getX(Position $position): float
    {
        $projectedX = $this->projection->getX($position);

        return $this->boundingBox->boundX($projectedX);
    }

    public function getY(Position $position): float
    {
        $projectedY = $this->projection->getY($position);

        return $this->boundingBox->boundY($projectedY);
    }
}
