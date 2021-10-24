<?php
declare(strict_types=1);

namespace HTML\Elements;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\HTML\Elements\Element;
use PrinsFrank\PhpGeoSVG\HTML\Elements\GroupElement;
use PrinsFrank\PhpGeoSVG\HTML\Elements\PathElement;
use PrinsFrank\PhpGeoSVG\HTML\Elements\SvgElement;
use PrinsFrank\PhpGeoSVG\HTML\Elements\Text\TextContent;
use PrinsFrank\PhpGeoSVG\HTML\Elements\TitleElement;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\HTML\Elements\Element
 */
class ElementTest extends TestCase
{
    private Element $element;

    protected function setUp(): void
    {
        parent::setUp();

        $this->element = new class extends Element {
            public function getTagName(): string
            {
                return 'test';
            }
        };
    }

    /**
     * @covers ::getChildElements
     * @covers ::addChildElement
     */
    public function testChildElements(): void
    {
        $element = $this->element;
        static::assertSame([], $element->getChildElements());

        $childElement1 = new TitleElement();
        $element->addChildElement($childElement1);
        static::assertSame([$childElement1], $element->getChildElements());

        $childElement2 = new TitleElement();
        $element->addChildElement($childElement2);
        static::assertSame([$childElement1, $childElement2], $element->getChildElements());
    }

    /**
     * @covers ::setAttribute
     * @covers ::getAttributes
     */
    public function testAttributes(): void
    {
        $element = $this->element;
        static::assertSame([], $element->getAttributes());

        $element->setAttribute('foo', 'bar');
        static::assertSame(['foo' => 'bar'], $element->getAttributes());

        $element->setAttribute('bar', 'foo');
        static::assertSame(['foo' => 'bar', 'bar' => 'foo'], $element->getAttributes());

        $element->setAttribute('bar', 'bop');
        static::assertSame(['foo' => 'bar', 'bar' => 'bop'], $element->getAttributes());
    }

    /**
     * @covers ::getTextContent
     * @covers ::setTextContent
     */
    public function testTextContent(): void
    {
        $element = $this->element;
        static::assertNull($element->getTextContent());

        $textContent1 = new TextContent();
        $element->setTextContent($textContent1);
        static::assertSame($textContent1, $element->getTextContent());

        $textContent2 = new TextContent();
        $element->setTextContent($textContent2);
        static::assertSame($textContent2, $element->getTextContent());
    }

    /**
     * @covers ::canSelfClose
     */
    public function testCanSelfCloseNonForeignElements(): void
    {
        static::assertFalse((new TitleElement())->canSelfClose());
    }

    /**
     * @covers ::canSelfClose
     */
    public function testCanSelfCloseWhenWithChildElements(): void
    {
        static::assertFalse((new GroupElement())->addChildElement(new PathElement())->canSelfClose());
    }

    /**
     * @covers ::canSelfClose
     */
    public function testCanSelfCloseWhenWithTextContent(): void
    {
        static::assertFalse((new GroupElement())->setTextContent(new TextContent())->canSelfClose());
    }

    /**
     * @covers ::canSelfClose
     */
    public function testCanSelfClose(): void
    {
        static::assertTrue((new GroupElement())->canSelfClose());
        static::assertTrue((new PathElement())->canSelfClose());
        static::assertTrue((new SvgElement())->canSelfClose());
    }
}
