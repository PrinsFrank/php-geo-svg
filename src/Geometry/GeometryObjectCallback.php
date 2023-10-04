<?php

namespace PrinsFrank\PhpGeoSVG\Geometry;

use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\GeometryObject;
use PrinsFrank\PhpGeoSVG\Html\Elements\Element;

interface GeometryObjectCallback
{
    function __invoke(GeometryObject $geometryObject, Element $element): void;
}