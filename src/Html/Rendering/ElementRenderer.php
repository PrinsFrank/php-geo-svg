<?php

declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\Html\Rendering;

use PrinsFrank\PhpGeoSVG\Exception\RecursionException;
use PrinsFrank\PhpGeoSVG\Html\Elements\Element;

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

        $elementContent = null;
        foreach ($element->getChildElements() as $childElement) {
            $elementContent .= str_repeat(self::INDENTING_CHAR, $currentDepth) . self::renderElement($childElement, $currentDepth);
        }

        if (null !== $element->getTextContent()) {
            $elementContent .= str_repeat(self::INDENTING_CHAR, $currentDepth) . $element->getTextContent()->getContent() . PHP_EOL;
        }

        $attributeString = AttributeRenderer::renderAttributes($element->getAttributes());
        if (null === $elementContent && $element->canSelfClose()) {
            return '<' . $element->getTagName() . (null !== $attributeString ? ' ' . $attributeString : null) . '/>' . PHP_EOL;
        }

        return '<' . $element->getTagName() . (null !== $attributeString ? ' ' . $attributeString : null) . '>' . PHP_EOL .
            $elementContent .
        str_repeat(self::INDENTING_CHAR, $currentDepth - 1) . '</' . $element->getTagName() . '>' . PHP_EOL;
    }
}
