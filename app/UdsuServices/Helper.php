<?php
/**
 * С помощью Небес!
 *
 * @copyright   2021 Ivan Novostruev emsitef@gmail.com
 */

namespace App\UdsuServices;

use stdClass;
use ReflectionObject;

class Helper
{
    /**
     * Объекты в PHP передаются ПО ССЫЛКЕ!!!
     *
     * Переопределяет значения свойств объекта $moodleUser
     * соответствующими значениями свойств объекта $updatedMoodleUser
     *
     * Метод служит для обновления объекта $moodleUser
     * Это необходимо для того, чтобы пользователя, после его первого входа в Систему,
     * не перенаправляло на страницу редактирования профиля
     *
     * @param stdClass $object
     * @param stdClass $updatedObject Обновленная запись moodle-пользователя в БД
     */
    public static function overrideObjectProperties(stdClass $object, stdClass $updatedObject): void
    {
        $reflectionUser = new ReflectionObject($object);
        $properties = (new ReflectionObject($updatedObject))->getProperties();
        foreach ($properties as $property) {
            $name = $property->getName();
            if ($reflectionUser->hasProperty($name)) {
                $object->$name = $updatedObject->$name;
            }
        }
    }

    /**
     * @param $data
     * @return stdClass|null
     */
    public static function convertSimpleXmlElementToStdClass($data): ?stdClass
    {
        return json_decode(json_encode($data));
    }
}
