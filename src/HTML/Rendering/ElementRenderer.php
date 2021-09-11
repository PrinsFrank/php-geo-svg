<?php

namespace PrinsFrank\PhpGeoSVG\HTML\Rendering;

use PrinsFrank\PhpGeoSVG\Exception\RecursionException;
use PrinsFrank\PhpGeoSVG\HTML\Elements\Element;

class ElementRenderer
{
    private const RECURSION_LIMIT = 100;

    /**
     * @throws RecursionException
     */
    public static function renderElement(Element $element, int $depth): string
    {
        if ($depth++ > self::RECURSION_LIMIT) {
            throw new RecursionException('Recursion limit of ' . self::RECURSION_LIMIT . ' Reached');
        }

        $elementContent = null;
        foreach ($element->getChildElements() as $childElement) {
            $elementContent .= self::renderElement($childElement, $depth);
        }

        return '<' . $element->getTagName() . AttributeRenderer::renderAttributes($element->getAttributes()) . '>' .
            $elementContent .
        '</' . $element->getTagName() . '>';
    }
}
