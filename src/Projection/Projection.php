<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Projection;

use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;

interface Projection
{
    public function getX(Position $position): float;

    public function getY(Position $position): float;

    public function getMaxX(): float;

    public function getMaxY(): float;

    public function getMaxLatitude(): float;
}
