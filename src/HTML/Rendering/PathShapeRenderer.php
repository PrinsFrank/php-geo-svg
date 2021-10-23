<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\HTML\Rendering;

use PrinsFrank\PhpGeoSVG\Coordinator\Coordinator;
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

    public static function renderLineStringPath(LineString $lineString, Coordinator $coordinator): string
    {
        $renderedLineString = '';
        foreach ($lineString->getPositions() as $key => $position) {
            if ($key === 0) {
                $renderedLineString .= self::MOVE_TO;
            } else {
                $renderedLineString .= ' ' . self::LINE_TO;
            }

            $renderedLineString .= $coordinator->getX($position) . ' ' . $coordinator->getY($position);
        }

        return $renderedLineString;
    }
}
