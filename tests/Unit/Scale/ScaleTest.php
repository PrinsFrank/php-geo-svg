<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\Scale;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Scale\Scale;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Scale\Scale
 */
class ScaleTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getFactorX
     * @covers ::getFactorY
     */
    public function testFactorOnlyX(): void
    {
        $scale = new Scale(42.0);
        static::assertSame(42.0, $scale->getFactorX());
        static::assertSame(42.0, $scale->getFactorY());
    }

    /**
     * @covers ::__construct
     * @covers ::getFactorX
     * @covers ::getFactorY
     */
    public function testFactorDifferentY(): void
    {
        $scale = new Scale(42.0, 43.0);
        static::assertSame(42.0, $scale->getFactorX());
        static::assertSame(43.0, $scale->getFactorY());
    }
}
