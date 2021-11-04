<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Projection;

class ToblersProjection extends AbstractCylindricalEqualAreaProjection
{
    public function getStandardParallelDegree(): float
    {
        return acos(sqrt(M_1_PI));
    }

    public function getWidthToHeightAspectRatio(): float
    {
        return 1;
    }
}
