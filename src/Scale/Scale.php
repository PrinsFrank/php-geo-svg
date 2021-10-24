<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Scale;

class Scale
{
    private float $factorY;

    public function __construct(private float $factorX, ?float $factorY = null)
    {
        if ($factorY === null) {
            $factorY = $factorX;
        }

        $this->factorY = $factorY;
    }

    public function getFactorX(): float
    {
        return $this->factorX;
    }

    public function getFactorY(): float
    {
        return $this->factorY;
    }
}
