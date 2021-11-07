<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\Projection;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Projection\GallPetersProjection;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Projection\GallPetersProjection
 */
class GallPetersProjectionTest extends TestCase
{
    /**
     * @covers ::getWidthToHeightAspectRatio
     */
    public function testGetWidthToHeightAspectRatio(): void
    {
        static::assertEqualsWithDelta(1.570, (new GallPetersProjection())->getWidthToHeightAspectRatio(), 0.001);
    }
}
