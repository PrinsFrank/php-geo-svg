<?php

namespace PrinsFrank\PhpGeoSVG\HTML\Elements;

use PrinsFrank\PhpGeoSVG\HTML\Elements\Text\TextContent;

abstract class Element
{
    /** @var Element[] */
    protected array $childElements = [];

    /** @var array<string, string> */
    protected array      $attributes = [];
    private ?TextContent $textContent = null;

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

    public function setTextContent(?TextContent $textContent): self
    {
        $this->textContent = $textContent;

        return $this;
    }

    abstract public function getTagName(): string;
}
