<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Projection;

class HoboDyerProjection extends AbstractCylindricalEqualAreaProjection
{
    public function getStandardParallelDegree(): float
    {
        return 37.5;
    }

    public function getWidthToHeightAspectRatio(): float
    {
        return 1.977;
    }
}
