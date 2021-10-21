<?php

namespace PrinsFrank\PhpGeoSVG\HTML\Elements;

use PrinsFrank\PhpGeoSVG\HTML\Elements\NameSpace\SvgNameSpace;

class CircleElement extends Element implements SvgNameSpace
{
    public function getTagName(): string
    {
        return 'circle';
    }
}
