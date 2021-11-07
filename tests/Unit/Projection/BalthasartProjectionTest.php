<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\Projection;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Projection\BalthasartProjection;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Projection\BalthasartProjection
 */
class BalthasartProjectionTest extends TestCase
{
    /**
     * @covers ::getWidthToHeightAspectRatio
     */
    public function testGetWidthToHeightAspectRatio(): void
    {
        static::assertSame(1.298, (new BalthasartProjection())->getWidthToHeightAspectRatio());
    }
}
