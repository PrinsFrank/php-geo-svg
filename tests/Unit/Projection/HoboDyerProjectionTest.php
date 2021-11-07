<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\Projection;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Projection\HoboDyerProjection;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Projection\HoboDyerProjection
 */
class HoboDyerProjectionTest extends TestCase
{
    /**
     * @covers ::getWidthToHeightAspectRatio
     */
    public function testGetWidthToHeightAspectRatio(): void
    {
        static::assertSame(1.977, (new HoboDyerProjection())->getWidthToHeightAspectRatio());
    }
}
