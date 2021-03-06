<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Projection;

class BehrmannProjection extends AbstractCylindricalEqualAreaProjection
{
    public function getWidthToHeightAspectRatio(): float
    {
        return 3 * M_PI / 4;
    }
}
