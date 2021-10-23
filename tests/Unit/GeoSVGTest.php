<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Geometry\BoundingBox\BoundingBox;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;
use PrinsFrank\PhpGeoSVG\GeoSVG;
use PrinsFrank\PhpGeoSVG\Projection\EquiRectangularProjection;
use PrinsFrank\PhpGeoSVG\Projection\MercatorProjection;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\GeoSVG
 */
class GeoSVGTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getProjection
     */
    public function testGetProjectionDefaultsEquiRectangular(): void
    {
        static::assertInstanceOf(EquiRectangularProjection::class, (new GeoSVG())->getProjection());
    }

    /**
     * @covers ::__construct
     * @covers ::getProjection
     */
    public function testGetProjectionReturnsProjectionProvidedUsingConstructor(): void
    {
        $projection = new MercatorProjection();

        static::assertSame($projection, (new GeoSVG($projection))->getProjection());
    }

    /**
     * @covers ::setProjection
     * @covers ::getProjection
     */
    public function testGetProjectionReturnsProjectionProvidedUsingSetProjectionMethod(): void
    {
        $projection = new MercatorProjection();

        static::assertSame($projection, (new GeoSVG())->setProjection($projection)->getProjection());
    }
    /**
     * @covers ::__construct
     * @covers ::getBoundingBox
     */
    public function testGetBoundingBoxReturnsDefaultOne(): void
    {
        static::assertEquals(
            new BoundingBox(new Position(-180, -90), new Position(180, 90)),
            (new GeoSVG())->getBoundingBox()
        );
    }

    /**
     * @covers ::__construct
     * @covers ::getBoundingBox
     */
    public function testGetBoundingBoxReturnsBoundingBoxProvidedUsingConstructor(): void
    {
        $boundingBox = new BoundingBox(new Position(1,2), new Position(3, 4));

        static::assertSame($boundingBox, (new GeoSVG(null, $boundingBox))->getBoundingBox());
    }

    /**
     * @covers ::setBoundingBox
     * @covers ::getBoundingBox
     */
    public function testGetBoundingBoxReturnsBoundingBoxProvidedUsingSetBoundingBoxMethod(): void
    {
        $boundingBox = new BoundingBox(new Position(1,2), new Position(3, 4));

        static::assertSame($boundingBox, (new GeoSVG())->setBoundingBox($boundingBox)->getBoundingBox());
    }
}