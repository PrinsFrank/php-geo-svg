<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Geometry\GeometryObject;

abstract class GeometryObject
{
    protected ?string $title        = null;
    protected ?string $featureClass = null;
    protected ?array $properties = null;

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setFeatureClass(string $featureClass): self
    {
        $this->featureClass = $featureClass;

        return $this;
    }

    public function getFeatureClass(): ?string
    {
        return $this->featureClass;
    }

    public function getProperties(): ?array
    {
        return $this->properties;
    }

    public function setProperties(array $properties): void
    {
        $this->properties = $properties;
    }


}
