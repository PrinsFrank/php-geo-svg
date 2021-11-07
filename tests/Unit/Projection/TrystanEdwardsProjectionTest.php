<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\Projection;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Projection\TrystanEdwardsProjection;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Projection\TrystanEdwardsProjection
 */
class TrystanEdwardsProjectionTest extends TestCase
{
    /**
     * @covers ::getWidthToHeightAspectRatio
     */
    public function testGetWidthToHeightAspectRatio(): void
    {
        static::assertSame(1.983, (new TrystanEdwardsProjection())->getWidthToHeightAspectRatio());
    }
}
