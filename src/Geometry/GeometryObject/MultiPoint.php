<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Geometry\GeometryObject;

class MultiPoint extends GeometryObject
{
    /** @var Point[] */
    protected array $points = [];

    public function addPoint(Point $point): self
    {
        $this->points[] = $point;

        return $this;
    }

    /**
     * @return Point[]
     */
    public function getPoints(): array
    {
        return $this->points;
    }
}
