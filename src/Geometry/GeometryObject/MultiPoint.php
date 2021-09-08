<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Geometry\GeometryObject;

use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;

class MultiPoint implements GeometryObject
{
    /** @var Position[] */
    protected array $positions;
}