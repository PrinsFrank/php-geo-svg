<?php

declare(strict_types=1);

namespace Geometry;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryCollection;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\LineString;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiLineString;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Geometry\GeometryCollection
 */
class GeometryCollectionTest extends TestCase
{
    /**
     * @covers ::addGeometryObject
     * @covers ::getGeometryObjects
     */
    public function testGetAddGeometryObject(): void
    {
        $geometryCollection = new GeometryCollection();
        static::assertSame([], $geometryCollection->getGeometryObjects());

        $lineString = new LineString();
        $geometryCollection->addGeometryObject($lineString);
        static::assertSame([$lineString], $geometryCollection->getGeometryObjects());

        $multiLineString = new MultiLineString();
        $geometryCollection->addGeometryObject($multiLineString);
        static::assertSame([$lineString, $multiLineString], $geometryCollection->getGeometryObjects());
    }
}
