<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\Html\Rendering;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Exception\InvalidArgumentException;
use PrinsFrank\PhpGeoSVG\Html\Rendering\AttributeRenderer;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Html\Rendering\AttributeRenderer
 */
class AttributeRendererTest extends TestCase
{
    /**
     * @covers ::renderAttributes
     */
    public function testRenderAttributesThrowsExceptionWithNonStringAttributeName(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Attribute names have to be of type string, "integer"(0) given.');

        AttributeRenderer::renderAttributes(['foo']);
    }

    /**
     * @covers ::renderAttributes
     */
    public function testRenderAttributesThrowsExceptionWithNonStringAttributeValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Attribute values have to be of type string, "integer"(42) given.');

        AttributeRenderer::renderAttributes(['foo' => 42]);
    }

    /**
     * @covers ::renderAttributes
     */
    public function testRenderAttributes(): void
    {
        static::assertNull(AttributeRenderer::renderAttributes([]));
        static::assertSame('foo="bar"', AttributeRenderer::renderAttributes(['foo' => 'bar']));
        static::assertSame('foo="bar" bar="foo"', AttributeRenderer::renderAttributes(['foo' => 'bar', 'bar' => 'foo']));
    }

    /**
     * @covers ::renderAttribute
     */
    public function testRenderAttribute(): void
    {
        static::assertSame('foo="bar"', AttributeRenderer::renderAttribute('foo', 'bar'));
        static::assertSame('foo="\\\'bar\\\'"', AttributeRenderer::renderAttribute('foo', '\'bar\''));
        static::assertSame('foo="\'bar\'"', AttributeRenderer::renderAttribute('foo', '"bar"'));
        static::assertSame('foo="\'bar\', \\\'bar\\\'"', AttributeRenderer::renderAttribute('foo', '"bar", \'bar\''));
    }
}
