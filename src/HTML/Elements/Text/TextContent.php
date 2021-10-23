<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\HTML\Elements\Text;

class TextContent
{
    public function __construct(protected ?string $content = null)
    {
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }
}
