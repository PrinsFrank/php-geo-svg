<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit;

use PhpCsFixer\Diff\Line;
use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Geometry\BoundingBox\BoundingBox;
use PrinsFrank\PhpGeoSVG\Geometry\BoundingBox\BoundingBoxPosition;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryCollection;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\LineString;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiLineString;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;
use PrinsFrank\PhpGeoSVG\GeoSVG;
use PrinsFrank\PhpGeoSVG\Projection\EquiRectangularProjection;
use PrinsFrank\PhpGeoSVG\Projection\MercatorProjection;
use PrinsFrank\PhpGeoSVG\Scale\Scale;

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
            new BoundingBox(new BoundingBoxPosition(-180, -90), new BoundingBoxPosition(180, 90)),
            (new GeoSVG())->getBoundingBox()
        );
    }

    /**
     * @covers ::__construct
     * @covers ::getBoundingBox
     */
    public function testGetBoundingBoxReturnsBoundingBoxProvidedUsingConstructor(): void
    {
        $boundingBox = new BoundingBox(new BoundingBoxPosition(1, 2), new BoundingBoxPosition(3, 4));

        static::assertSame($boundingBox, (new GeoSVG(null, $boundingBox))->getBoundingBox());
    }

    /**
     * @covers ::setBoundingBox
     * @covers ::getBoundingBox
     */
    public function testGetBoundingBoxReturnsBoundingBoxProvidedUsingSetBoundingBoxMethod(): void
    {
        $boundingBox = new BoundingBox(new BoundingBoxPosition(1, 2), new BoundingBoxPosition(3, 4));

        static::assertSame($boundingBox, (new GeoSVG())->setBoundingBox($boundingBox)->getBoundingBox());
    }

    /**
     * @covers ::getScale
     * @covers ::setScale
     */
    public function testScale(): void
    {
        $geoSVG = new GeoSVG();
        static::assertEquals(new Scale(1), $geoSVG->getScale());

        $scale = new Scale(10);
        $geoSVG->setScale($scale);
        static::assertSame($scale, $geoSVG->getScale());
    }

    /**
     * @covers ::render
     */
    public function testRender(): void
    {
        static::assertSame(
            '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="720" height="360" viewbox="0 0 720 360">' . PHP_EOL .
            ' <g>' . PHP_EOL .
            '  <path d="M0 0"/>' . PHP_EOL .
            ' </g>' . PHP_EOL .
            '</svg>' . PHP_EOL,
            (new GeoSVG())->render(
                (new GeometryCollection())
                    ->addGeometryObject(
                        (new MultiLineString())
                            ->addLineString(
                                (new LineString())
                                    ->addPosition(new Position(-180, 90))
                            )
                    )
            )
        );
    }

    /**
     * @covers ::toFile
     */
    public function testToFile(): void
    {
        (new GeoSVG())->toFile(
            (new GeometryCollection())
                ->addGeometryObject(
                    (new MultiLineString())
                        ->addLineString(
                            (new LineString())
                                ->addPosition(new Position(-180, 90))
                        )
                ),
            __DIR__ . '/geo_svg_test_actual.svg'
        );

        static::assertFileEquals(__DIR__ . '/geo_svg_test_expected.svg', __DIR__ . '/geo_svg_test_actual.svg');
    }
}
