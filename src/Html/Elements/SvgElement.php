<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Html\Elements;

use PrinsFrank\PhpGeoSVG\Html\Elements\Definition\ForeignElement;

class SvgElement extends Element implements ForeignElement
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
