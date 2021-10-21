<?php

namespace PrinsFrank\PhpGeoSVG\HTML\Rendering;

use PrinsFrank\PhpGeoSVG\Exception\RecursionException;
use PrinsFrank\PhpGeoSVG\HTML\Elements\Element;

class ElementRenderer
{
    private const RECURSION_LIMIT = 100;
    private const INDENTING_CHAR  = ' ';

    /**
     * @throws RecursionException
     */
    public static function renderElement(Element $element, int $currentDepth = 0): string
    {
        if ($currentDepth++ > self::RECURSION_LIMIT) {
            throw new RecursionException('Recursion limit of ' . self::RECURSION_LIMIT . ' Reached');
        }

        $elementContent = null;
        foreach ($element->getChildElements() as $childElement) {
            $elementContent .= str_repeat(self::INDENTING_CHAR, $currentDepth) . self::renderElement($childElement, $currentDepth);
        }

        if ($element->getTextContent() !== null) {
            $elementContent .= str_repeat(self::INDENTING_CHAR, $currentDepth) . $element->getTextContent()->getContent() . PHP_EOL;
        }

        $attributeString = AttributeRenderer::renderAttributes($element->getAttributes());
        if ($elementContent === null && $element->canSelfClose()) {
            return '<' . $element->getTagName() . ($attributeString !== null ? ' ' . $attributeString : null) . '/>' . PHP_EOL;
        }

        return '<' . $element->getTagName() . ($attributeString !== null ? ' ' . $attributeString : null) . '>' . PHP_EOL .
            $elementContent .
        str_repeat(self::INDENTING_CHAR, $currentDepth - 1) . '</' . $element->getTagName() . '>' . PHP_EOL;
    }
}
