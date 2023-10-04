<?php

declare(strict_types=1);

namespace Geometry;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryCollection;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\GeometryObject;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\LineString;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiLineString;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObjectCallback;
use PrinsFrank\PhpGeoSVG\Html\Elements\Element;

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

        $geometryObjectCallback = new class implements GeometryObjectCallback {
            function __invoke(GeometryObject $geometryObject, Element $element): void
            {}
        };
        $geometryCollection->setGeometryObjectCallback($geometryObjectCallback);
        static::assertSame($geometryObjectCallback, $geometryCollection->getGeometryObjectCallback());
    }
}
