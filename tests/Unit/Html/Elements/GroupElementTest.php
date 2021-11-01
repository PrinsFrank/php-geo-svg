<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\Html\Elements;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Html\Elements\GroupElement;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Html\Elements\GroupElement
 */
class GroupElementTest extends TestCase
{
    /**
     * @covers ::getTagName
     */
    public function testGetTagName(): void
    {
        static::assertSame('g', (new GroupElement())->getTagName());
    }
}
