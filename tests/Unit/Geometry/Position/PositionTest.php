<?php
declare(strict_types=1);

namespace Geometry\Position;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Exception\InvalidPositionException;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Geometry\Position\Position
 */
class PositionTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testThrowsExceptionWhenLongitudeTooHigh(): void
    {
        $this->expectException(InvalidPositionException::class);
        $this->expectExceptionMessage('The longitude should be between -180 and 180, "180.01" provided.');

        new Position(180.01, 0);
    }

    /**
     * @covers ::__construct
     */
    public function testThrowsExceptionWhenLongitudeTooLow(): void
    {
        $this->expectException(InvalidPositionException::class);
        $this->expectExceptionMessage('The longitude should be between -180 and 180, "-180.01" provided.');

        new Position(-180.01, 0);
    }

    /**
     * @covers ::__construct
     */
    public function testThrowsExceptionWhenLatitudeTooHigh(): void
    {
        $this->expectException(InvalidPositionException::class);
        $this->expectExceptionMessage('The latitude should be between -90 and 90, "90.01" provided.');

        new Position(0, 90.01);
    }

    /**
     * @covers ::__construct
     */
    public function testThrowsExceptionWhenLatitudeTooLow(): void
    {
        $this->expectException(InvalidPositionException::class);
        $this->expectExceptionMessage('The latitude should be between -90 and 90, "-90.01" provided.');

        new Position(0, -90.01);
    }

    /**
     * @covers ::__construct
     */
    public function testValidBoundingBoxPositions(): void
    {
        new Position(0, 0);
        new Position(180, 90);
        new Position(-180, 90);
        new Position(180, -90);
        new Position(-180, -90);

        // There are no assertions as we only check if there is no exception thrown here
        $this->addToAssertionCount(1);
    }

    /**
     * @covers ::__construct
     * @covers ::hasElevation
     */
    public function testHasElevation(): void
    {
        static::assertFalse((new Position(0, 0))->hasElevation());
        static::assertFalse((new Position(0, 0, null))->hasElevation());
        static::assertFalse((new Position(0, 0, 0))->hasElevation());
        static::assertFalse((new Position(0, 0, 0.0))->hasElevation());

        static::assertTrue((new Position(0, 0, -42))->hasElevation());
        static::assertTrue((new Position(0, 0, -42.0))->hasElevation());
        static::assertTrue((new Position(0, 0, 42))->hasElevation());
        static::assertTrue((new Position(0, 0, 42.0))->hasElevation());
    }
}
