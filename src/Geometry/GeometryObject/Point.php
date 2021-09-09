<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Geometry\GeometryObject;

use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;

class Point implements GeometryObject
{
    public function __construct(protected Position $position)
    {
    }
}