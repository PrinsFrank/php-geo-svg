<?php
declare(strict_types=1);

namespace Geometry\BoundingBox;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Exception\InvalidBoundingBoxPositionException;
use PrinsFrank\PhpGeoSVG\Geometry\BoundingBox\BoundingBoxPosition;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Geometry\BoundingBox\BoundingBoxPosition
 */
class BoundingBoxPositionTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testThrowsExceptionWhenLongitudeTooHigh(): void
    {
        $this->expectException(InvalidBoundingBoxPositionException::class);
        $this->expectExceptionMessage('The longitude should be between -360 and 360, "360.01" provided.');

        new BoundingBoxPosition(360.01, 0);
    }

    /**
     * @covers ::__construct
     */
    public function testThrowsExceptionWhenLongitudeTooLow(): void
    {
        $this->expectException(InvalidBoundingBoxPositionException::class);
        $this->expectExceptionMessage('The longitude should be between -360 and 360, "-360.01" provided.');

        new BoundingBoxPosition(-360.01, 0);
    }

    /**
     * @covers ::__construct
     */
    public function testThrowsExceptionWhenLatitudeTooHigh(): void
    {
        $this->expectException(InvalidBoundingBoxPositionException::class);
        $this->expectExceptionMessage('The latitude should be between -90 and 90, "90.01" provided.');

        new BoundingBoxPosition(0, 90.01);
    }

    /**
     * @covers ::__construct
     */
    public function testThrowsExceptionWhenLatitudeTooLow(): void
    {
        $this->expectException(InvalidBoundingBoxPositionException::class);
        $this->expectExceptionMessage('The latitude should be between -90 and 90, "-90.01" provided.');

        new BoundingBoxPosition(0, -90.01);
    }

    /**
     * @covers ::__construct
     */
    public function testValidBoundingBoxPositions(): void
    {
        new BoundingBoxPosition(0, 0);
        new BoundingBoxPosition(360, 90);
        new BoundingBoxPosition(-360, 90);
        new BoundingBoxPosition(360, -90);
        new BoundingBoxPosition(-360, -90);

        // There are no assertions as we only check if there is no exception thrown here
        $this->addToAssertionCount(1);
    }
}
