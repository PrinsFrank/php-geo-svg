<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Projection;

class ToblersWorldInASquareProjection extends AbstractCylindricalEqualAreaProjection
{
    public function getWidthToHeightAspectRatio(): float
    {
        return 1;
    }
}
