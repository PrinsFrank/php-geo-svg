<?php

declare(strict_types=1);

namespace Geometry\GeometryObject;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\LineString;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiLineString;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\MultiLineString
 */
class MultiLineStringTest extends TestCase
{
    /**
     * @covers ::getLineStrings
     * @covers ::addLineString
     */
    public function testGetAddPositions(): void
    {
        $multiLineString = new MultiLineString();
        static::assertSame([], $multiLineString->getLineStrings());

        $lineString1 = new LineString();
        $multiLineString->addLineString($lineString1);
        static::assertSame([$lineString1], $multiLineString->getLineStrings());

        $lineString2 = new LineString();
        $multiLineString->addLineString($lineString2);
        static::assertSame([$lineString1, $lineString2], $multiLineString->getLineStrings());
    }
}
