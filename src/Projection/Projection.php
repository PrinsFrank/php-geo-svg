<?php

namespace PrinsFrank\PhpGeoSVG\Projection;

interface Projection
{
    public function getX(float $longitude, float $latitude): float;

    public function getY(float $longitude, float $latitude): float;

    public function getMinX(): float;

    public function getMaxX(): float;

    public function getMinY(): float;

    public function getMaxY(): float;

    public function getCoordinatesTransformation(): ?string;
}
