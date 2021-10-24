<?php
declare(strict_types=1);

namespace Geometry\GeometryObject;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\LineString;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\Polygon;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\Polygon
 */
class PolygonTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getExteriorRing
     */
    public function testExteriorRing(): void
    {
        $exteriorRing = new LineString();
        $polygon = new Polygon($exteriorRing);

        static::assertSame($exteriorRing, $polygon->getExteriorRing());
    }

    /**
     * @covers ::getInteriorRings
     * @covers ::addInteriorRing
     */
    public function testInteriorRings(): void
    {
        $polygon = new Polygon(new LineString());
        static::assertSame([], $polygon->getInteriorRings());

        $interiorRing1 = new LineString();
        $polygon->addInteriorRing($interiorRing1);
        static::assertSame([$interiorRing1], $polygon->getInteriorRings());

        $interiorRing2 = new LineString();
        $polygon->addInteriorRing($interiorRing2);
        static::assertSame([$interiorRing1, $interiorRing2], $polygon->getInteriorRings());
    }
}
