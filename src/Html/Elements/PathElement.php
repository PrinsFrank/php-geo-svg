<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Html\Elements;

use PrinsFrank\PhpGeoSVG\Html\Elements\NameSpace\SvgNameSpace;

class PathElement extends Element implements SvgNameSpace
{
    public function getTagName(): string
    {
        return 'path';
    }
}
