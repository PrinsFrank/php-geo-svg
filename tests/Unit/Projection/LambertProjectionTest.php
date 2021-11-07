<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\Projection;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Projection\LambertProjection;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Projection\LambertProjection
 */
class LambertProjectionTest extends TestCase
{
    /**
     * @covers ::getWidthToHeightAspectRatio
     */
    public function testGetWidthToHeightAspectRatio(): void
    {
        static::assertEqualsWithDelta(3.141, (new LambertProjection())->getWidthToHeightAspectRatio(), 0.001);
    }
}
