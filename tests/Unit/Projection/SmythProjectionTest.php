<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\Projection;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Projection\SmythProjection;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Projection\SmythProjection
 */
class SmythProjectionTest extends TestCase
{
    /**
     * @covers ::getWidthToHeightAspectRatio
     */
    public function testGetWidthToHeightAspectRatio(): void
    {
        static::assertSame(2.0, (new SmythProjection())->getWidthToHeightAspectRatio());
    }
}
