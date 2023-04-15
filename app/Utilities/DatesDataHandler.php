<?php

namespace App\Utilities;

use DateTime;
use ErrorException;

class DatesDataHandler
{
    /**
     * @param string $dates
     * @return array
     * @throws ErrorException
     */
    public static function handle(string $dates): array
    {
        $dates = self::trim($dates);
        $dates = self::removeSpaces($dates);
        $dates = self::toArray($dates);
        self::guardDatesWithoutDuplicates($dates);
        $dates = self::convert($dates);
        return $dates;
    }

    /**
     * @param string $dates
     * @return string
     */
    private static function trim(string $dates): string
    {
        return trim($dates, ' ,');
    }

    /**
     * @param string $string
     * @return string
     */
    private static function removeSpaces(string $string): string
    {
        return str_replace(' ', '', $string);
    }

    /**
     * @param string $dates
     * @return array
     */
    private static function toArray(string $dates): array
    {
        $separator = ',';

        return explode($separator, $dates);
    }

    /**
     * @param array $dates
     * @return array
     * @throws ErrorException
     */
    private static function convert(array $dates): array
    {
        $formatFrom = 'd.m.Y';
        $formatTo   = 'Y-m-d';

        foreach ($dates as &$date) {
            self::guardDateExists($date);
            $date = DateTime::createFromFormat($formatFrom, $date)->format($formatTo);
        }
        return $dates;
    }

    /**
     * Solution: https://stackoverflow.com/questions/3145607/php-check-if-an-array-has-duplicates
     *
     * @param array $dates
     * @throws ErrorException
     */
    private static function guardDatesWithoutDuplicates(array $dates)
    {
        $errorMessage = 'В поле "Даты проведения" были обнаружены дубликаты дат';

        if (count($dates) !== count(array_flip($dates))) {
            throw new ErrorException($errorMessage);
        }
    }

    /**
     * @param string $date
     * @return void
     * @throws ErrorException
     */
    private static function guardDateExists(string $date): void
    {
        $separator = '.'; // mm.dd.YYYY
        $messageFormat = 'Даты %s не существует';

        [$day, $month, $year] = explode($separator, $date);
        if (!checkdate($month, $day, $year)) {
            throw new ErrorException(sprintf($messageFormat, $date));
        }
    }
}
