<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG;

use PrinsFrank\PhpGeoSVG\Coordinator\Coordinator;
use PrinsFrank\PhpGeoSVG\Exception\PhpGeoSVGException;
use PrinsFrank\PhpGeoSVG\Geometry\BoundingBox\BoundingBox;
use PrinsFrank\PhpGeoSVG\Geometry\BoundingBox\BoundingBoxPosition;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryCollection;
use PrinsFrank\PhpGeoSVG\Html\Factory\ElementFactory;
use PrinsFrank\PhpGeoSVG\Html\Rendering\ElementRenderer;
use PrinsFrank\PhpGeoSVG\Projection\EquiRectangularProjection;
use PrinsFrank\PhpGeoSVG\Projection\Projection;
use PrinsFrank\PhpGeoSVG\Scale\Scale;

class GeoSVG
{
    public const VENDOR_NAME  = 'prinsfrank';
    public const PACKAGE_NAME = 'php-geo-svg';

    public const PACKAGE_PATH = self::VENDOR_NAME . '/' . self::PACKAGE_NAME;

    private ?Scale $scale = null;

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
        if (null === $this->projection) {
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
        if (null === $this->boundingBox) {
            $this->boundingBox = new BoundingBox(new BoundingBoxPosition(-180, -90), new BoundingBoxPosition(180, 90));
        }

        return $this->boundingBox;
    }

    public function setScale(?Scale $scale): self
    {
        $this->scale = $scale;

        return $this;
    }

    public function getScale(): Scale
    {
        if (null === $this->scale) {
            $this->scale = new Scale(1);
        }

        return $this->scale;
    }

    /**
     * @throws PhpGeoSVGException
     */
    public function render(GeometryCollection $geometryCollection): string
    {
        return ElementRenderer::renderElement(
            ElementFactory::buildForGeometryCollection($geometryCollection, new Coordinator($this->getProjection(), $this->getBoundingBox(), $this->getScale()))
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
