<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\Projection;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Projection\ToblersWorldInASquareProjection;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Projection\ToblersWorldInASquareProjection
 */
class ToblersWorldInASquareProjectionTest extends TestCase
{
    /**
     * @covers ::getWidthToHeightAspectRatio
     */
    public function testGetWidthToHeightAspectRatio(): void
    {
        static::assertSame(1.0, (new ToblersWorldInASquareProjection())->getWidthToHeightAspectRatio());
    }
}
