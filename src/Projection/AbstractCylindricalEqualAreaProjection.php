<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Projection;

use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;

abstract class AbstractCylindricalEqualAreaProjection implements Projection
{
    abstract public function getStandardParallelDegree(): float;

    abstract public function getWidthToHeightAspectRatio(): float;

    public function getX(Position $position): float
    {
        return (deg2rad($position->longitude) - 0) * cos(deg2rad($this->getStandardParallelDegree()));
    }

    public function getY(Position $position): float
    {
        return sin($position->latitude) / cos($this->getStandardParallelDegree());
    }

    public function getMaxX(): float
    {
        return 360;
    }

    public function getMaxY(): float
    {
        return 700;
    }

    public function getMaxLatitude(): float
    {
        return 90;
    }
}
