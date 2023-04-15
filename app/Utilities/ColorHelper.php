<?php

namespace App\Utilities;

class ColorHelper
{
    /**
     * Solution:
     * https://stackoverflow.com/questions/1855884/determine-font-color-based-on-background-color
     * https://stackoverflow.com/questions/3942878/how-to-decide-font-color-in-white-or-black-depending-on-background-color
     *
     * @param string $hex
     * @return int
     */
    public static function determineColorTone(string $hex): int
    {
        [$red, $green, $blue] = self::hexToRgb($hex);

        $backgroundLuminance  = (0.299 * $red + 0.587 * $green + 0.114 * $blue) / 255;

        return $backgroundLuminance > 0.5 ? 1 : 0;
    }

    /**
     * @param string $hex
     * @return array
     */
    public static function hexToRgb(string $hex): array
    {
        return sscanf($hex, "#%02x%02x%02x");
    }
}
