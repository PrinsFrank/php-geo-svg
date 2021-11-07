<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Projection;

use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;

abstract class AbstractCylindricalEqualAreaProjection implements Projection
{
    abstract public function getWidthToHeightAspectRatio(): float;

    public function getX(Position $position): float
    {
        return ($position->longitude - Position::MIN_LONGITUDE) * $this->getWidthToHeightAspectRatio() / 2;
    }

    public function getY(Position $position): float
    {
        return (-sin(deg2rad($position->latitude)) + 1) * .5 * Position::TOTAL_LATITUDE;
    }

    public function getMaxX(): float
    {
        return $this->getMaxY() * $this->getWidthToHeightAspectRatio();
    }

    public function getMaxY(): float
    {
        return Position::TOTAL_LATITUDE;
    }

    public function getMaxLatitude(): float
    {
        return Position::MAX_LATITUDE;
    }
}
