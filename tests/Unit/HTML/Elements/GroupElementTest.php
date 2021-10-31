<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\HTML\Elements;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\HTML\Elements\GroupElement;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\HTML\Elements\GroupElement
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
