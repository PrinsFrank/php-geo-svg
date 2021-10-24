<?php
declare(strict_types=1);

namespace Geometry\GeometryObject;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\LineString;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiPolygon;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\Polygon;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiPolygon
 */
class MultiPolygonTest extends TestCase
{
    /**
     * @covers ::addPolygon
     * @covers ::getPolygons
     */
    public function testPolygons(): void
    {
        $multiPolygon = new MultiPolygon();
        static::assertSame([], $multiPolygon->getPolygons());

        $polygon1 = new Polygon(new LineString());
        $multiPolygon->addPolygon($polygon1);
        static::assertSame([$polygon1], $multiPolygon->getPolygons());

        $polygon2 = new Polygon(new LineString());
        $multiPolygon->addPolygon($polygon2);
        static::assertSame([$polygon1, $polygon2], $multiPolygon->getPolygons());
    }
}
