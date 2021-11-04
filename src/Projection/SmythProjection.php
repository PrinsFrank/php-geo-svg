<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Projection;

class SmythProjection extends AbstractCylindricalEqualAreaProjection
{
    public function getStandardParallelDegree(): float
    {
        return acos(sqrt(M_2_PI));
    }

    public function getWidthToHeightAspectRatio(): float
    {
        return 2;
    }
}
