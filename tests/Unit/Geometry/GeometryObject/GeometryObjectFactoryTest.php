<?php

declare(strict_types=1);

namespace Geometry\GeometryObject;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\GeometryObjectFactory;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\Point;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\GeometryObjectFactory
 */
class GeometryObjectFactoryTest extends TestCase
{
    /**
     * @covers ::createForPointCoordinates
     */
    public function testCreateForPointCoordinates(): void
    {
        static::assertEquals(
            new Point(new Position(1, 2)),
            GeometryObjectFactory::createForPointCoordinates([1 ,2])
        );

        static::assertEquals(
            new Point(new Position(1, 2, 3)),
            GeometryObjectFactory::createForPointCoordinates([1, 2, 3])
        );
    }
}
