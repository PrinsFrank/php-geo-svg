<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\HTML\Rendering;

use PrinsFrank\PhpGeoSVG\Exception\InvalidArgumentException;

class AttributeRenderer
{
    /**
     * @param array<string, string> $attributes
     * @throws InvalidArgumentException
     */
    public static function renderAttributes(array $attributes): ?string
    {
        $attributesString = null;
        foreach($attributes as $attributeName => $attributeValue) {
            if (is_string($attributeName) === false) {
                throw new InvalidArgumentException('Attribute names have to be of type string, "' . gettype($attributeName) . '" given.');
            }

            if (is_string($attributeValue) === false) {
                throw new InvalidArgumentException('Attribute values have to be of type string, "' . gettype($attributeValue) . '" given.');
            }

            if ($attributesString !== null) {
                $attributesString .= ' ';
            }

            $attributesString .= self::renderAttribute($attributeName, $attributeValue);
        }

        return $attributesString;
    }

    public static function renderAttribute(string $attributeName, string $attributeValue): string
    {
        return $attributeName . '="' . str_replace(['\'', '"'], ['\\\'', '\''], $attributeValue) . '"';
    }
}
