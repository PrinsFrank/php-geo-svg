<?php

declare(strict_types=1);

namespace Geometry\GeometryObject;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\GeometryObject;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\GeometryObject
 */
class GeometryObjectTest extends TestCase
{
    private GeometryObject $geometryObject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->geometryObject = new class () extends GeometryObject {};
    }

    /**
     * @covers ::getTitle
     * @covers ::setTitle
     */
    public function testTitle(): void
    {
        $geometryObject = $this->geometryObject;
        static::assertNull($geometryObject->getTitle());

        $geometryObject->setTitle('foo');
        static::assertSame('foo', $geometryObject->getTitle());

        $geometryObject->setTitle(null);
        static::assertNull($geometryObject->getTitle());
    }

    /**
     * @covers ::getFeatureClass
     * @covers ::setFeatureClass
     */
    public function testFeatureClass(): void
    {
        $geometryObject = $this->geometryObject;
        static::assertNull($geometryObject->getFeatureClass());

        $geometryObject->setFeatureClass('foo');
        static::assertSame('foo', $geometryObject->getFeatureClass());
    }

    /**
     * @covers ::getProperties
     * @covers ::setProperties
     */
    public function testProperties(): void
    {
        $geometryObject = $this->geometryObject;
        static::assertNull($geometryObject->getProperties());

        $geometryObject->setProperties(['foo' => 'bar']);
        static::assertSame(['foo' => 'bar'], $geometryObject->getProperties());
    }
}
