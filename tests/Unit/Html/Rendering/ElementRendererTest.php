<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Tests\Unit\Html\Rendering;

use PHPUnit\Framework\TestCase;
use PrinsFrank\PhpGeoSVG\Exception\RecursionException;
use PrinsFrank\PhpGeoSVG\Html\Elements\GroupElement;
use PrinsFrank\PhpGeoSVG\Html\Elements\PathElement;
use PrinsFrank\PhpGeoSVG\Html\Elements\Text\TextContent;
use PrinsFrank\PhpGeoSVG\Html\Elements\TitleElement;
use PrinsFrank\PhpGeoSVG\Html\Rendering\ElementRenderer;

/**
 * @coversDefaultClass \PrinsFrank\PhpGeoSVG\Html\Rendering\ElementRenderer
 */
class ElementRendererTest extends TestCase
{
    /**
     * @covers ::renderElement
     */
    public function testRenderElementThrowsRecursionExceptionWithCircularReference(): void
    {
        $element1 = new GroupElement();
        $element2 = new GroupElement();
        $element1->addChildElement($element2);
        $element2->addChildElement($element1);

        $this->expectException(RecursionException::class);
        $this->expectExceptionMessage('Recursion limit of 10 Reached');
        ElementRenderer::renderElement($element1);
    }

    /**
     * @covers ::renderElement
     */
    public function testRenderElementThrowsRecursionExceptionWithDeepTree(): void
    {
        $element1 = new GroupElement();
        $element2 = new GroupElement();
        $element1->addChildElement($element2);
        $element3 = new GroupElement();
        $element2->addChildElement($element3);
        $element4 = new GroupElement();
        $element3->addChildElement($element4);
        $element5 = new GroupElement();
        $element4->addChildElement($element5);
        $element6 = new GroupElement();
        $element5->addChildElement($element6);
        $element7 = new GroupElement();
        $element6->addChildElement($element7);
        $element8 = new GroupElement();
        $element7->addChildElement($element8);
        $element9 = new GroupElement();
        $element8->addChildElement($element9);
        $element10 = new GroupElement();
        $element9->addChildElement($element10);
        $element11 = new GroupElement();
        $element10->addChildElement($element11);
        $element12 = new GroupElement();
        $element11->addChildElement($element12);

        $this->expectException(RecursionException::class);
        $this->expectExceptionMessage('Recursion limit of 10 Reached');
        ElementRenderer::renderElement($element1);
    }

    /**
     * @covers ::renderElement
     */
    public function testRenderElementWithEmptySelfClosingElement(): void
    {
        static::assertSame('<path/>' . PHP_EOL, ElementRenderer::renderElement(new PathElement()));
    }

    /**
     * @covers ::renderElement
     */
    public function testRenderElementWithEmptyNonSelfClosingElement(): void
    {
        static::assertSame('<title>' . PHP_EOL . '</title>' . PHP_EOL, ElementRenderer::renderElement(new TitleElement()));
    }

    /**
     * @covers ::renderElement
     */
    public function testRenderElementWithTextContent(): void
    {
        static::assertSame(
            '<title>' . PHP_EOL .
            ' foo' . PHP_EOL .
            '</title>' . PHP_EOL,
            ElementRenderer::renderElement((new TitleElement())->setTextContent(new TextContent('foo')))
        );
        static::assertSame(
            '<path>' . PHP_EOL .
            ' foo' . PHP_EOL .
            '</path>' . PHP_EOL,
            ElementRenderer::renderElement((new PathElement())->setTextContent(new TextContent('foo')))
        );
    }

    /**
     * @covers ::renderElement
     */
    public function testRenderElementThatCannotSelfCloseWithAttributes(): void
    {
        static::assertSame(
            '<title foo="bar" bar="foo">' . PHP_EOL .
            '</title>' . PHP_EOL,
            ElementRenderer::renderElement((new TitleElement())->setAttribute('foo', 'bar')->setAttribute('bar', 'foo'))
        );
    }

    /**
     * @covers ::renderElement
     */
    public function testRenderElementThatCanSelfCloseWithAttributes(): void
    {
        static::assertSame(
            '<path bar="bop"/>' . PHP_EOL,
            ElementRenderer::renderElement((new PathElement())->setAttribute('bar', 'bop'))
        );
    }

    /**
     * @covers ::renderElement
     */
    public function testRenderElementThatCannotSelfCloseWithChildElement(): void
    {
        static::assertSame(
            '<title>' . PHP_EOL .
            ' <path/>' . PHP_EOL .
            '</title>' . PHP_EOL,
            ElementRenderer::renderElement((new TitleElement())->addChildElement(new PathElement()))
        );
    }

    /**
     * @covers ::renderElement
     */
    public function testRenderElementThatCanSelfCloseWithChildElement(): void
    {
        static::assertSame(
            '<path>' . PHP_EOL .
            ' <title>' . PHP_EOL .
            ' </title>' . PHP_EOL .
            '</path>' . PHP_EOL,
            ElementRenderer::renderElement((new PathElement())->addChildElement(new TitleElement()))
        );
    }
}
