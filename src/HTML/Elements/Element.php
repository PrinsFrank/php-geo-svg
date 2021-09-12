<?php

namespace PrinsFrank\PhpGeoSVG\HTML\Elements;

abstract class Element
{
    /** @var Element[] */
    protected array $childElements = [];

    /** @var array<string, string> */
    protected array $attributes = [];

    public function addChildElement(Element $childElement): self
    {
        $this->childElements[] = $childElement;

        return $this;
    }

    /**
     * @return Element[]
     */
    public function getChildElements(): array
    {
        return $this->childElements;
    }

    /**
     * @return array<string, string>
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function setAttribute(string $name, mixed $value): self
    {
        $this->attributes[$name] = $value;

        return $this;
    }

    abstract public function getTagName(): string;
}
