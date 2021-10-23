<?php
declare(strict_types=1);

namespace PrinsFrank\PhpGeoSVG\HTML\Rendering;

class AttributeRenderer
{
    /**
     * @param array<string, string> $attributes
     */
    public static function renderAttributes(array $attributes): ?string
    {
        $attributesString = null;
        foreach($attributes as $attribute => $value) {
            if ($attributesString !== null) {
                $attributesString .= ' ';
            }

            $attributesString .= self::renderAttribute($attribute, $value);
        }

        return $attributesString;
    }

    public static function renderAttribute(string $attribute, string $value): string
    {
        return $attribute . '="' . $value . '"';
    }
}
