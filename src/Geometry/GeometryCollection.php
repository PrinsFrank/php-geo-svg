<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Geometry;

use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\GeometryObject;

class GeometryCollection
{
    /** @var GeometryObject[] */
    protected array $geometryObjects = [];

    /** @var ?GeometryObjectCallback */
    protected ?GeometryObjectCallback $geometryObjectCallback = null;

    public function addGeometryObject(GeometryObject $geometryObject): self
    {
        $this->geometryObjects[] = $geometryObject;

        return $this;
    }

    /**
     * @return GeometryObject[]
     */
    public function getGeometryObjects(): array
    {
        return $this->geometryObjects;
    }

    /**
     * @return GeometryObjectCallback
     */
    public function getGeometryObjectCallback(): ?GeometryObjectCallback
    {
        return $this->geometryObjectCallback;
    }

    /**
     * @param GeometryObjectCallback $geometryObjectCallback
     * @return void
     */
    public function setGeometryObjectCallback(GeometryObjectCallback $geometryObjectCallback): void
    {
        $this->geometryObjectCallback = $geometryObjectCallback;
    }


}
