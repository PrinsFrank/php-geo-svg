<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\Projection;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Projection\BehrmannProjection;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Projection\BehrmannProjection
 */
class BehrmannProjectionTest extends TestCase
{
    /**
     * @covers ::getWidthToHeightAspectRatio
     */
    public function testGetWidthToHeightAspectRatio(): void
    {
        static::assertEqualsWithDelta(2.356, (new BehrmannProjection())->getWidthToHeightAspectRatio(), 0.001);
    }
}
