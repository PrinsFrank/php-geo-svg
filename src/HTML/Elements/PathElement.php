<?php

namespace PrinsFrank\PhpGeoSVG\HTML\Elements;

use PrinsFrank\PhpGeoSVG\HTML\Elements\NameSpace\SvgNameSpace;

class PathElement extends Element implements SvgNameSpace
{
    public function getTagName(): string
    {
        return 'path';
    }
}
