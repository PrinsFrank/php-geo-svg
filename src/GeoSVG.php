<?php

namespace PrinsFrank\PhpGeoSVG;

use PrinsFrank\PhpGeoSVG\Coordinator\Coordinator;
use PrinsFrank\PhpGeoSVG\Exception\PhpGeoSVGException;
use PrinsFrank\PhpGeoSVG\Geometry\BoundingBox\BoundingBox;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryCollection;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;
use PrinsFrank\PhpGeoSVG\HTML\Factory\ElementFactory;
use PrinsFrank\PhpGeoSVG\HTML\Rendering\ElementRenderer;
use PrinsFrank\PhpGeoSVG\Projection\EquiRectangularProjection;
use PrinsFrank\PhpGeoSVG\Projection\Projection;

class GeoSVG
{
    public function __construct(private ?Projection $projection = null, private ?BoundingBox $boundingBox = null)
    {
    }

    public function setProjection(?Projection $projection): self
    {
        $this->projection = $projection;

        return $this;
    }

    public function getProjection(): Projection
    {
        if ($this->projection === null) {
            $this->projection = new EquiRectangularProjection();
        }

        return $this->projection;
    }

    public function setBoundingBox(?BoundingBox $boundingBox): self
    {
        $this->boundingBox = $boundingBox;

        return $this;
    }

    /**
     * @throws null suppress hinting on the thrown exception as the default positions and bounding box are correct so catching these is not useful
     */
    public function getBoundingBox(): BoundingBox
    {
        if ($this->boundingBox === null) {
            $this->boundingBox = new BoundingBox(new Position(-180, 90), new Position(180, -90));
        }

        return $this->boundingBox;
    }

    /**
     * @throws PhpGeoSVGException
     */
    public function render(GeometryCollection $geometryCollection): string
    {
        return ElementRenderer::renderElement(
            ElementFactory::buildForGeometryCollection($geometryCollection, new Coordinator($this->getProjection(), $this->getBoundingBox()))
        );
    }

    /**
     * @throws PhpGeoSVGException
     */
    public function toFile(GeometryCollection $geometryCollection, string $path): void
    {
        file_put_contents($path, $this->render($geometryCollection));
    }
}
