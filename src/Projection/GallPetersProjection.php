<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Projection;

class GallPetersProjection extends AbstractCylindricalEqualAreaProjection
{
    public function getWidthToHeightAspectRatio(): float
    {
        return M_PI_2;
    }
}
