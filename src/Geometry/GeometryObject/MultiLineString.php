<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Geometry\GeometryObject;

class MultiLineString implements GeometryObject
{
    /** @var LineString[] */
    protected array $lineStrings;
}