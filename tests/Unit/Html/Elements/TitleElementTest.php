<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\Html\Elements;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Html\Elements\TitleElement;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Html\Elements\TitleElement
 */
class TitleElementTest extends TestCase
{
    /**
     * @covers ::getTagName
     */
    public function testGetTagName(): void
    {
        static::assertSame('title', (new TitleElement())->getTagName());
    }
}
