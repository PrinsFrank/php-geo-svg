<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Html\Elements;

use PrinsFrank\PhpGeoSVG\Html\Elements\Definition\ForeignElement;

class PathElement extends Element implements ForeignElement
{
    public function getTagName(): string
    {
        return 'path';
    }
}
