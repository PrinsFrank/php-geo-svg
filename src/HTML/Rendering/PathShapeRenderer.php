<?php

namespace PrinsFrank\PhpGeoSVG\HTML\Rendering;

use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\LineString;

class PathShapeRenderer
{
    public const MOVE_TO               = 'M';
    public const LINE_TO               = 'L';
    public const HORIZONTAL_LINE       = 'H';
    public const VERTICAL_LINE         = 'V';
    public const CLOSE_PATH            = 'Z';
    public const CUBIC_CURVE           = 'C';
    public const SHORT_CUBIC_CURVE     = 'S';
    public const QUADRATIC_CURVE       = 'Q';
    public const SHORT_QUADRATIC_CURVE = 'T';
    public const ARC                   = 'A';

    public static function renderLineStringPath(LineString $lineString): string
    {
        $renderedLineString = '';
        foreach ($lineString->getPositions() as $key => $position) {
            if ($key === 0) {
                $renderedLineString .= self::MOVE_TO;
            } else {
                $renderedLineString .= ' ' . self::LINE_TO;
            }

            $renderedLineString .= $position->longitude . ' ' . $position->latitude;
        }

        return $renderedLineString;
    }
}
