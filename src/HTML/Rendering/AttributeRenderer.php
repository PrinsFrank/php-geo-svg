<?php

namespace PrinsFrank\PhpGeoSVG\HTML\Rendering;

class AttributeRenderer
{
    /**
     * @param array<string, string> $attributes
     */
    public static function renderAttributes(array $attributes): string
    {
        $attributesString = '';
        foreach($attributes as $attribute => $value) {
            $attributesString .= self::renderAttribute($attribute, $value);
        }

        return $attributesString;
    }

    public static function renderAttribute(string $attribute, string $value): string
    {
        return $attribute . '="' . $value . '"';
    }
}
