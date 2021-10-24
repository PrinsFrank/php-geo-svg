<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Geometry\GeometryObject;

use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;

class MultiPoint extends GeometryObject
{
    /** @var Position[] */
    protected array $positions = [];

    public function addPosition(Position $position): self
    {
        $this->positions[] = $position;

        return $this;
    }

    /**
     * @return Position[]
     */
    public function getPositions(): array
    {
        return $this->positions;
    }
}
