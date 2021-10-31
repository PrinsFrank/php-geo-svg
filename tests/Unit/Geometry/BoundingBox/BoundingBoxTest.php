<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\Geometry\BoundingBox;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Exception\InvalidBoundingBoxException;
use PrinsFrank\PhpGeoSVG\Geometry\BoundingBox\BoundingBox;
use PrinsFrank\PhpGeoSVG\Geometry\BoundingBox\BoundingBoxPosition;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Geometry\BoundingBox\BoundingBox
 */
class BoundingBoxTest extends TestCase
{
    /**
     * -------------------------------------------------------------
     *   |      |      |######|######|######|######|      |      | Default View box
     *   |   xxx|xxx   |      |      |      |      |      |      | Unnecessarily in wrapped context
     *   |      |      |      |      |   vvv|vvv   |      |      | Could be rotated into this context resulting in the same view
     *   |      |      |######|######|######|######|      |      | Default View box
     * -------------------------------------------------------------
     * -360   -270   -180    -90     0     90     180    270    360
     *
     * @covers ::__construct
     */
    public function testViewBoxUnnecessarilyRotatedWest(): void
    {
        $this->expectException(InvalidBoundingBoxException::class);
        $this->expectExceptionMessage('The bounding box is unnecessarily rotated. Use a maxLongitude of "135" instead to achieve the same bound.');

        new BoundingBox(new BoundingBoxPosition(-315, 0), new BoundingBoxPosition(-225, 0));
    }

    /**
     * -------------------------------------------------------------
     *   |      |      |######|######|######|######|      |      | Default View box
     *   |      |      |      |      |      |      |   xxx|xxx   | Unnecessarily in rotated context
     *   |      |      |   vvv|vvv   |      |      |      |      | Could be rotated into this context resulting in the same view
     *   |      |      |######|######|######|######|      |      | Default View box
     * -------------------------------------------------------------
     * -360   -270   -180    -90     0     90     180    270    360
     *
     * @covers ::__construct
     */
    public function testViewBoxUnnecessarilyRotatedEast(): void
    {
        $this->expectException(InvalidBoundingBoxException::class);
        $this->expectExceptionMessage('The bounding box is unnecessarily rotated. Use a minLongitude of "-135" instead to achieve the same bound.');

        new BoundingBox(new BoundingBoxPosition(225, 0), new BoundingBoxPosition(315, 0));
    }

    /**
     * @covers ::__construct
     */
    public function testNorthSouthBoundingBoxFlipped(): void
    {
        $this->expectException(InvalidBoundingBoxException::class);
        $this->expectExceptionMessage('The latitude of the NorthEastern coordinate (-45) is south of the SouthWestern coordinate (45)');

        new BoundingBox(new BoundingBoxPosition(0, 45), new BoundingBoxPosition(0, -45));
    }

    /**
     * @covers ::__construct
     */
    public function testEastWestBoundingBoxFlipped(): void
    {
        $this->expectException(InvalidBoundingBoxException::class);
        $this->expectExceptionMessage('The longitude of the NorthEastern coordinate (-90) is west of the SouthWestern coordinate (90)');

        new BoundingBox(new BoundingBoxPosition(90, 0), new BoundingBoxPosition(-90, 0));
    }
}
