<?php
/**
 * С помощью Небес!
 *
 * @copyright   2022 Novostruev Ivan emsitef@gmail.com
 */

namespace App\Novostruev;

class DataChecker
{
    /**
     * @param $name
     * @return string
     */
    public static function checkName($name): string
    {
        $name = trim((string) $name);
        if (!$name) {
            return '';
        }

        if (!preg_match('/^[a-zA-Zа-яА-ЯЁё0-9.()_\-]+$/u', $name)) {
            return 'В названии группы присутствуют недопустимые символы:'
                . ' название может состоять только из букв, цифр и дефисов';
        }
        return '';
    }

    /**
     * @param $fullName
     * @return string
     */
    public static function checkFullname($fullName): string
    {
        $fullName = trim((string) $fullName);
        if (!$fullName) {
            return 'ФИО пустое';
        }

        if (!preg_match('/^[a-zA-Zа-яА-ЯЁё0-9\- ]+$/u', $fullName)) {
            return 'В имени преподавателя присутствуют недопустимые символы:'
                . ' имя может состоять только из букв, цифр, дефисов и пробелов';
        }
        return '';
    }

    /**
     * @param $email
     * @return string
     */
    public static function checkEmail($email): string
    {
        $email = trim((string) $email);
        if (!$email) {
            return '';
        }

//        if (!preg_match('/^[A-Za-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/u', $email)) {
//            return 'В email присутствуют недопустимые символы:'
//                . ' email может состоять только из букв, цифр и дефисов';
//        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'Email ' . $email . ' некорректный';
        }
        return '';
    }
}

