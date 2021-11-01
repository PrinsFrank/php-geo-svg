<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\Html\Rendering;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Coordinator\Coordinator;
use PrinsFrank\PhpGeoSVG\Geometry\GeometryObject\LineString;
use PrinsFrank\PhpGeoSVG\Geometry\Position\Position;
use PrinsFrank\PhpGeoSVG\Html\Rendering\PathShapeRenderer;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Html\Rendering\PathShapeRenderer
 */
class PathShapeRendererTest extends TestCase
{
    /**
     * @covers ::renderLineStringPath
     */
    public function testRenderLineStringPathWithoutPositions(): void
    {
        $coordinator = $this->createMock(Coordinator::class);

        static::assertSame('', PathShapeRenderer::renderLineStringPath(new LineString(), $coordinator));
    }

    /**
     * @covers ::renderLineStringPath
     */
    public function testRenderLineStringPathWithOnlyOnePosition(): void
    {
        $lineString = new LineString();
        $position = new Position(42, -42);
        $lineString->addPosition($position);

        $coordinator = $this->createMock(Coordinator::class);
        $coordinator->expects(static::once())->method('getX')->with($position)->willReturn(21.0);
        $coordinator->expects(static::once())->method('getY')->with($position)->willReturn(84.0);

        static::assertSame('M21 84', PathShapeRenderer::renderLineStringPath($lineString, $coordinator));
    }

    /**
     * @covers ::renderLineStringPath
     */
    public function testRenderLineStringPath(): void
    {
        $lineString = new LineString();
        $position1 = new Position(42, -42);
        $lineString->addPosition($position1);
        $position2 = new Position(12, 23);
        $lineString->addPosition($position2);
        $position3 = new Position(46, -50);
        $lineString->addPosition($position3);

        $coordinator = $this->createMock(Coordinator::class);
        $coordinator->expects(static::exactly(3))
            ->method('getX')
            ->withConsecutive([$position1], [$position2], [$position3])
            ->willReturnOnConsecutiveCalls(42, 12, 46);
        $coordinator->expects(static::exactly(3))
            ->method('getY')
            ->withConsecutive([$position1], [$position2], [$position3])
            ->willReturnOnConsecutiveCalls(8, 27, 0);

        static::assertSame('M42 8 L12 27 L46 0', PathShapeRenderer::renderLineStringPath($lineString, $coordinator));
    }
}
