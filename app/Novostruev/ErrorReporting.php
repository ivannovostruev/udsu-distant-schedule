<?php
/**
 * С помощью Небес!
 *
 * @copyright   2022 Novostruev Ivan emsitef@gmail.com
 */

namespace App\Novostruev;

class ErrorReporting
{
    /**
     * @param array $errorMessages
     * @return string
     */
    public static function generate(array $errorMessages): string
    {
        $text = '';

        if (empty($errorMessages)) {
            return '';
        }

        foreach ($errorMessages as $row => $messages) {
            $text .= "<strong>Ряд $row:</strong><br>";
            foreach ($messages as $message) {
                $text .= "&nbsp;&nbsp;$message<br>";
            }
            $text .= "<br>";
        }
        return $text;
    }
}
