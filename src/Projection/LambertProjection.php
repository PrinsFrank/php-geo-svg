<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Projection;

class LambertProjection extends AbstractCylindricalEqualAreaProjection
{
    public function getStandardParallelDegree(): float
    {
        return 0;
    }

    public function getWidthToHeightAspectRatio(): float
    {
        return M_PI;
    }
}
