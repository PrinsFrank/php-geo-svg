<?php

namespace PrinsFrank\PhpGeoSVG\HTML\Elements;

class SvgElement extends Element
{
    public const XMLNS   = 'http://www.w3.org/2000/svg';
    public const VERSION = '1.1';

    /** @var array<string, string> */
    protected array $attributes = [
        'xmlns' => self::XMLNS,
        'version' => self::VERSION
    ];

    public function getTagName(): string
    {
        return 'svg';
    }
}
