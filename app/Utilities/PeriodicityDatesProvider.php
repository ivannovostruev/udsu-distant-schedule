<?php

namespace App\Utilities;

use App\Models\Schedule\LessonPeriodicity;
use ErrorException;
use Illuminate\Support\Carbon;

class PeriodicityDatesProvider
{
    private static string $errorMessage = 'Неверно указана периодичность';

    /**
     * @param int $periodicity
     * @param array $data
     * @return array
     * @throws ErrorException
     */
    public static function get(int $periodicity, array $data): array
    {
        return match($periodicity) {
            LessonPeriodicity::WEEKLY   => self::weeklyDates($data),
            LessonPeriodicity::EVEN     => self::evenDates($data),
            LessonPeriodicity::ODD      => self::oddDates($data),
            LessonPeriodicity::EVERYDAY => self::everydayDates($data),
            default => throw new ErrorException(self::$errorMessage)
        };
    }

    /**
     * @param array $data
     * @return array
     */
    private static function weeklyDates(array $data): array
    {
        $dates = [];

        $dateStart  = $data['date'];
        $dateEnd    = $data['expiration_date'];

        $dates[]    = $data['date'];

        $dStart = Carbon::createFromFormat('Y-m-d', $dateStart);
        $dEnd   = Carbon::createFromFormat('Y-m-d', $dateEnd);

        $dCurrent = $dStart->addDays(7);
        while ($dEnd->gte($dCurrent)) {
            $dates[] = $dCurrent->format('Y-m-d');
            $dCurrent = $dCurrent->addDays(7);
        }
        return $dates;
    }

    /**
     * @param array $data
     * @return array
     */
    private static function evenDates(array $data): array
    {
        $dates = [];

        $dateStart  = $data['date'];
        $dateEnd    = $data['expiration_date'];

        $dates[]    = $data['date'];

        $dStart = Carbon::createFromFormat('Y-m-d', $dateStart);
        $dEnd   = Carbon::createFromFormat('Y-m-d', $dateEnd);

        $dCurrent = $dStart->addDays(14);
        while ($dEnd->gte($dCurrent)) {
            $dates[] = $dCurrent->format('Y-m-d');
            $dCurrent = $dCurrent->addDays(14);
        }
        return $dates;
    }

    /**
     * @param array $data
     * @return array
     */
    private static function oddDates(array $data): array
    {
        $dates = [];

        $dateStart  = $data['date'];
        $dateEnd    = $data['expiration_date'];

        $dates[]    = $data['date'];

        $dStart = Carbon::createFromFormat('Y-m-d', $dateStart);
        $dEnd   = Carbon::createFromFormat('Y-m-d', $dateEnd);

        $dCurrent = $dStart->addDays(14);
        while ($dEnd->gte($dCurrent)) {
            $dates[] = $dCurrent->format('Y-m-d');
            $dCurrent = $dCurrent->addDays(14);
        }
        return $dates;
    }

    /**
     * @param array $data
     * @return array
     */
    private static function everydayDates(array $data): array
    {
        $dates = [];

        $dateStart  = $data['date'];
        $dateEnd    = $data['expiration_date'];

        $dates[]    = $data['date'];

        $dStart = Carbon::createFromFormat('Y-m-d', $dateStart);
        $dEnd   = Carbon::createFromFormat('Y-m-d', $dateEnd);

        $dCurrent = $dStart->addDay();
        while ($dEnd->gte($dCurrent)) {
            $dates[] = $dCurrent->format('Y-m-d');
            $dCurrent = $dCurrent->addDay();
        }
        return $dates;
    }
}
