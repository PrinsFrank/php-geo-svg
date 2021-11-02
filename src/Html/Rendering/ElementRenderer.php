<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Html\Rendering;

use PrinsFrank\PhpGeoSVG\Exception\InvalidArgumentException;
use PrinsFrank\PhpGeoSVG\Exception\RecursionException;
use PrinsFrank\PhpGeoSVG\Html\Elements\Element;
use PrinsFrank\PhpGeoSVG\Html\Elements\Text\TextContent;

class ElementRenderer
{
    private const RECURSION_LIMIT = 10;
    private const INDENTING_CHAR  = ' ';

    /**
     * @throws RecursionException
     */
    public static function renderElement(Element $element, int $currentDepth = 0): string
    {
        if ($currentDepth++ > self::RECURSION_LIMIT) {
            throw new RecursionException('Recursion limit of ' . self::RECURSION_LIMIT . ' Reached');
        }

        $childElementContent = self::renderChildElements($element->getChildElements(), $currentDepth);
        $textContent = self::renderTextContent($element->getTextContent(), $currentDepth);
        if (null === $childElementContent && null === $textContent && $element->canSelfClose()) {
            return self::renderSelfClosingElement($element);
        }

        $attributeString = AttributeRenderer::renderAttributes($element->getAttributes());
        return '<' . $element->getTagName() . (null !== $attributeString ? ' ' . $attributeString : null) . '>' . PHP_EOL .
            $childElementContent . $textContent .
        str_repeat(self::INDENTING_CHAR, $currentDepth - 1) . '</' . $element->getTagName() . '>' . PHP_EOL;
    }

    /**
     * @throws InvalidArgumentException
     */
    public static function renderSelfClosingElement(Element $element): string
    {
        if ($element->canSelfClose() === false) {
            throw new InvalidArgumentException('Only elements that can self close can be rendered as self closing elements');
        }

        $attributeString = AttributeRenderer::renderAttributes($element->getAttributes());
        return '<' . $element->getTagName() . (null !== $attributeString ? ' ' . $attributeString : null) . '/>' . PHP_EOL;
    }

    /**
     * @param Element[] $childElements
     * @throws RecursionException
     */
    public static function renderChildElements(array $childElements, int $currentDepth): ?string
    {
        $childElementString = null;
        foreach ($childElements as $childElement) {
            $childElementString .= str_repeat(self::INDENTING_CHAR, $currentDepth) . self::renderElement($childElement, $currentDepth);
        }

        return $childElementString;
    }

    public static function renderTextContent(?TextContent $textContent, int $currentDepth): ?string
    {
        if (null !== $textContent) {
            return str_repeat(self::INDENTING_CHAR, $currentDepth) . $textContent->getContent() . PHP_EOL;
        }

        return null;
    }
}
