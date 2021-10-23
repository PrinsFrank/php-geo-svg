<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\Geometry\BoundingBox;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Exception\ViewBoxOutOfBoundsException;
use PrinsFrank\PhpGeoSVG\Vertex\Vertex;
use PrinsFrank\PhpGeoSVG\Viewbox\ViewBox;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Viewbox\ViewBox
 */
class BoundingBoxTest extends TestCase
{
    /**
     * -------------------------------------------------------------
     *   |      |      |######|######|######|######|      |      | Default View box
     *   |      |      |######|######|######|######|      |      | Default View box
     *   |      |      |######|######|######|######|      |      | Default View box
     * -------------------------------------------------------------
     * -360   -270   -180    -90     0     90     180    270    360
     *
     * @covers ::getMaxLongitude
     * @covers ::getMinLongitude
     * @covers ::getWidth
     */
    public function testDefaultViewBoxLatitude(): void
    {
        $viewBox = new ViewBox();

        static::assertSame((float) Vertex::MAX_LATITUDE, $viewBox->getMaxLatitude());
        static::assertSame((float) Vertex::MIN_LATITUDE, $viewBox->getMinLatitude());
        static::assertSame(360.0, $viewBox->getWidth());
    }

    /**
     * -------------------------------------------------------------
     *   |      |      |######|######|######|######|      |      | Default View box
     *   |      |      |      |      |######|######|######|######| 180 Degree Wrapped east View box
     *   |      |      |######|######|######|######|      |      | Default View box
     * -------------------------------------------------------------
     * -360   -270   -180    -90     0     90     180    270    360
     *
     * @covers ::getMaxLongitude
     * @covers ::getMinLongitude
     * @covers ::getWidth
     * @covers ::setMinLongitude
     * @covers ::setMaxLongitude
     */
    public function test180DegreeEastViewBoxLatitude(): void
    {
        $viewBox = (new ViewBox())->setMaxLongitude(360)->setMinLongitude(0);

        static::assertSame(360.0, $viewBox->getMaxLongitude());
        static::assertSame(0.0, $viewBox->getMinLongitude());
        static::assertSame(360.0, $viewBox->getWidth());
    }

    /**
     * -------------------------------------------------------------
     *   |      |      |######|######|######|######|      |      | Default View box
     *   |######|######|######|######|      |      |      |      | 180 Degree Wrapped west View box
     *   |      |      |######|######|######|######|      |      | Default View box
     * -------------------------------------------------------------
     * -360   -270   -180    -90     0     90     180    270    360
     *
     * @covers ::getMaxLongitude
     * @covers ::getMinLongitude
     * @covers ::getWidth
     * @covers ::setMinLongitude
     * @covers ::setMaxLongitude
     */
    public function test180DegreeWestViewBoxLatitude(): void
    {
        $viewBox = (new ViewBox())->setMaxLongitude(0)->setMinLongitude(-360);

        static::assertSame(0.0, $viewBox->getMaxLongitude());
        static::assertSame(-360.0, $viewBox->getMinLongitude());
        static::assertSame(360.0, $viewBox->getWidth());
    }

    /**
     * -------------------------------------------------------------
     *   |      |      |######|######|######|######|      |      | Default View box
     *   |      |      |      |      |      |   ###|###   |      | Small View box On eastern wrapped edge
     *   |      |      |######|######|######|######|      |      | Default View box
     * -------------------------------------------------------------
     * -360   -270   -180    -90     0     90     180    270    360
     *
     * @covers ::getMaxLongitude
     * @covers ::getMinLongitude
     * @covers ::getWidth
     * @covers ::setMinLongitude
     * @covers ::setMaxLongitude
     */
    public function testSmallViewBoxLatitudeOnEasternWrappedEdge(): void
    {
        $viewBox = (new ViewBox())->setMaxLongitude(225)->setMinLongitude(135);

        static::assertSame(225.0, $viewBox->getMaxLongitude());
        static::assertSame(135.0, $viewBox->getMinLongitude());
        static::assertSame(90.0, $viewBox->getWidth());
    }

    /**
     * -------------------------------------------------------------
     *   |      |      |######|######|######|######|      |      | Default View box
     *   |      |   ###|###   |      |      |      |      |      | Small View box On western wrapped edge
     *   |      |      |######|######|######|######|      |      | Default View box
     * -------------------------------------------------------------
     * -360   -270   -180    -90     0     90     180    270    360
     *
     * @covers ::getMaxLongitude
     * @covers ::getMinLongitude
     * @covers ::getWidth
     * @covers ::setMinLongitude
     * @covers ::setMaxLongitude
     */
    public function testSmallViewBoxLatitudeOnWesternWrappedEdge(): void
    {
        $viewBox = (new ViewBox())->setMaxLongitude(-135)->setMinLongitude(-225);

        static::assertSame(-135.0, $viewBox->getMaxLongitude());
        static::assertSame(-225.0, $viewBox->getMinLongitude());
        static::assertSame(90.0, $viewBox->getWidth());
    }

    /**
     * -------------------------------------------------------------
     *   |      |      |######|######|######|######|      |      | Default View box
     *   |   xxx|xxx   |      |      |      |      |      |      | Unnecessarily in wrapped context
     *   |      |      |      |      |   vvv|vvv   |      |      | Could be rotated into this context resulting in the same view
     *   |      |      |######|######|######|######|      |      | Default View box
     * -------------------------------------------------------------
     * -360   -270   -180    -90     0     90     180    270    360
     *
     * @covers ::setMaxLongitude
     */
    public function testViewBoxUnnecessarilyRotatedWest(): void
    {
        $this->expectException(ViewBoxOutOfBoundsException::class);
        $this->expectExceptionMessage('The view box is unnecessarily rotated. Use a maxLongitude of "135" instead to achieve the same view.');

        (new ViewBox())->setMaxLongitude(-225);
    }

    /**
     * ----------------------------------------------------------------------------------------
     *   |      |      |      |      |      |      |######|######|######|######|      |      | Default View box
     *   |   xxx|xxx   |      |      |      |      |      |      |      |      |      |      | Unnecessarily in rotated context
     *   |      |      |      |      |      |      |      |      |   vvv|vvv   |      |      | Could be rotated into this context resulting in the same view
     *   |      |      |      |      |      |      |######|######|######|######|      |      | Default View box
     * ----------------------------------------------------------------------------------------
     * -720   -630   -540   -450   -360   -270   -180    -90     0     90     180    270    360
     *
     * @covers ::setMaxLongitude
     */
    public function testViewBoxAbsurdlyRotatedWest(): void
    {
        $this->expectException(ViewBoxOutOfBoundsException::class);
        $this->expectExceptionMessage('The view box is unnecessarily rotated. Use a maxLongitude of "135" instead to achieve the same view.');

        (new ViewBox())->setMaxLongitude(-585);
    }

    /**
     * -------------------------------------------------------------
     *   |      |      |######|######|######|######|      |      | Default View box
     *   |      |      |      |      |      |      |   xxx|xxx   | Unnecessarily in rotated context
     *   |      |      |   vvv|vvv   |      |      |      |      | Could be rotated into this context resulting in the same view
     *   |      |      |######|######|######|######|      |      | Default View box
     * -------------------------------------------------------------
     * -360   -270   -180    -90     0     90     180    270    360
     *
     * @covers ::setMinLongitude
     */
    public function testViewBoxUnnecessarilyRotatedEast(): void
    {
        $this->expectException(ViewBoxOutOfBoundsException::class);
        $this->expectExceptionMessage('The view box is unnecessarily rotated. Use a minLongitude of "-135" instead to achieve the same view.');

        (new ViewBox())->setMinLongitude(225);
    }

    /**
     * ------------------------------------------------------------------------------------------------------
     *   |      |      |######|######|######|######|      |      |      |      |      |      |      |      | Default View box
     *   |      |      |      |      |      |      |      |      |      |      |   xxx|xxx   |      |      | Unnecessarily in rotated context
     *   |      |      |   vvv|vvv   |      |      |      |      |      |      |      |      |      |      | Could be rotated into this context resulting in the same view
     *   |      |      |######|######|######|######|      |      |      |      |      |      |      |      | Default View box
     * ------------------------------------------------------------------------------------------------------
     * -360   -270   -180    -90     0     90     180    270    360    450    540    630    720    810    900
     *
     * @covers ::setMinLongitude
     */
    public function testViewBoxAbsurdlyRotatedEast(): void
    {
        $this->expectException(ViewBoxOutOfBoundsException::class);
        $this->expectExceptionMessage('The view box is unnecessarily rotated. Use a minLongitude of "-135" instead to achieve the same view.');

        (new ViewBox())->setMinLongitude(585);
    }
}
