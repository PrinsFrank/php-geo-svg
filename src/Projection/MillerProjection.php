<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Projection;

use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;

class MillerProjection extends MercatorProjection
{
    public function getY(Position $position): float
    {
        return parent::getY($position) / 5 * 4;
    }

    public function getMaxY(): float
    {
        return parent::getMaxY() / 5 * 4;
    }
}
