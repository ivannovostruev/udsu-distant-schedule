<?php
/**
 * С помощью Небес!
 *
 * @copyright   2022 Novostruev Ivan emsitef@gmail.com
 */

namespace App\Novostruev;

use ErrorException;

class DataHandler
{
    /**
     * @param string $firstname
     * @return string
     * @throws ErrorException
     */
    public static function getFirstname(string $firstname): string
    {
        $firstname = trim($firstname);
        if (!$firstname) {
            throw new ErrorException('Параметр "firstname" не определен');
        }
        return addcslashes($firstname, "'");
    }

    /**
     * @param string $lastname
     * @return string
     * @throws ErrorException
     */
    public static function getLastname(string $lastname): string
    {
        $lastname = trim($lastname);
        if (!$lastname) {
            throw new ErrorException('Параметр "lastname" не определен');
        }
        return addcslashes($lastname, "'");
    }

    /**
     * @param string $middlename
     * @return string
     * @throws ErrorException
     */
    public static function getMiddlename(string $middlename): string
    {
        $middlename = trim($middlename);
        if (!$middlename) {
            throw new ErrorException('Параметр "middlename" не определен');
        }
        return addcslashes($middlename, "'");
    }

    /**
     * @param string $name
     * @param bool $require
     * @return string|null
     * @throws ErrorException
     */
    public static function getName(string $name, bool $require=true): ?string
    {
        $name = trim($name);
        if ($require && !$name) {
            throw new ErrorException('Параметр "name" не определен');
        }
        return addcslashes($name, "'") ?: null;
    }

    /**
     * @param string $shortname
     * @return string
     */
    public static function getShortname(string $shortname): string
    {
        return addcslashes(trim($shortname), "'");
    }

    /**
     * @param string $phone
     * @return string|null
     */
    public static function getPhone(string $phone): ?string
    {
        return addcslashes(trim($phone), "'") ?: null;
    }

    /**
     * @param string $email
     * @return string|null
     * @throws ErrorException
     */
    public static function getEmail(string $email): ?string
    {
        $email = trim($email);
        if (!$email) {
            return null;
        }

        if (Helper::countWords($email) > 1) {
            throw new ErrorException('Указан некорректный Email');
        }
        return addcslashes(mb_strtolower($email), "'");
    }

    /**
     * @param string $description
     * @return string|null
     */
    public static function getDescription(string $description): ?string
    {
        return addcslashes(trim($description), "'") ?: null;
    }

    /**
     * @return int
     */
    public static function getTime(): int
    {
        return time();
    }

    /**
     * @param array $data
     * @return string
     */
    public static function getFullname(array $data): string
    {
        $lastname   = !empty($data['lastname'])     ? $data['lastname']             : '';
        $firstname  = !empty($data['firstname'])    ? (' ' . $data['firstname'])    : '';
        $middlename = !empty($data['middlename'])   ? (' ' . $data['middlename'])   : '';

        return ($lastname . $firstname . $middlename);
    }

    /**
     * @param string $address
     * @return string|null
     */
    public static function getAddress(string $address): ?string
    {
        return addcslashes(trim($address), "'") ?: null;
    }

    /**
     * @param string $supervisorId
     * @return int|null
     */
    public static function getSupervisorId(string $supervisorId): ?int
    {
        return ((int) $supervisorId) ?: null;
    }

    /**
     * @param string $googleMapLink
     * @return string|null
     */
    public static function getGoogleMapLink(string $googleMapLink): ?string
    {
        return addcslashes(trim($googleMapLink), "'") ?: null;
    }

    /**
     * @param string $yandexMapLink
     * @return string|null
     */
    public static function getYandexMapLink(string $yandexMapLink): ?string
    {
        return addcslashes(trim($yandexMapLink), "'") ?: null;
    }

    /**
     * @param string $propertyId
     * @return int
     * @throws ErrorException
     */
    public static function getPropertyId(string $propertyId): int
    {
        $propertyId = (int) $propertyId;
        if (!$propertyId) {
            throw new ErrorException('Параметр "property-id" не определен');
        }
        return $propertyId;
    }

    /**
     * @param string $parentId
     * @return int
     */
    public static function getParentId(string $parentId): int
    {
        return (int) $parentId;
    }

    /**
     * @param string $categoryId
     * @return int
     * @throws ErrorException
     */
    public static function getCategoryId(string $categoryId): int
    {
        $categoryId = (int) $categoryId;
        if (!$categoryId) {
            throw new ErrorException('Параметр "category-id" не определен');
        }
        return $categoryId;
    }

    /**
     * @param string $manufacturerId
     * @return int|null
     */
    public static function getManufacturerId(string $manufacturerId): ?int
    {
        return ((int) $manufacturerId) ?: null;
    }

    /**
     * @param string $model
     * @return string|null
     */
    public static function getModel(string $model): ?string
    {
        return addcslashes(trim($model), "'") ?: null;
    }

    /**
     * @param string $inventoryNumber
     * @return string
     * @throws ErrorException
     */
    public static function getInventoryNumber(string $inventoryNumber): string
    {
        $inventoryNumber = trim($inventoryNumber);
        if (!$inventoryNumber) {
            throw new ErrorException('Параметр "inventory-number" не определен');
        }
        return addcslashes($inventoryNumber, "'");
    }

    /**
     * @param string $serialNumber
     * @return string|null
     */
    public static function getSerialNumber(string $serialNumber): ?string
    {
        return addcslashes(trim($serialNumber), "'") ?: null;
    }

    /**
     * @param string $roomId
     * @return int
     * @throws ErrorException
     */
    public static function getRoomId(string $roomId): int
    {
        $roomId = (int) $roomId;
        if (!$roomId) {
            throw new ErrorException('Параметр "room-id" не определен');
        }
        return $roomId;
    }

    /**
     * @param string $materiallyLiablePersonId
     * @return int|null
     */
    public static function getMateriallyLiablePersonId(string $materiallyLiablePersonId): ?int
    {
        return ((int) $materiallyLiablePersonId) ?: null;
    }

    /**
     * @param string $isUsed
     * @return int
     */
    public static function getIsUsed(string $isUsed): int
    {
        return ((int) $isUsed) ? 1 : 0;
    }

    /**
     * @param string $isUsed
     * @return int
     */
    public static function getIsUsedAlt(string $isUsed): int
    {

        return ($isUsed === 'да') ? 1 : 0;
    }

    /**
     * @param string $whyNotUsed
     * @return string|null
     */
    public static function getWhyNotUsed(string $whyNotUsed): ?string
    {
        return addcslashes(trim($whyNotUsed), "'") ?: null;
    }

    /**
     * @param string $isRegistered
     * @return int
     */
    public static function getIsRegistered(string $isRegistered): int
    {
        return ((int) $isRegistered) ? 1 : 0;
    }

    /**
     * @param string $departmentId
     * @return int|null
     */
    public static function getDepartmentId(string $departmentId): ?int
    {
        return ((int) $departmentId) ?: null;
    }

    /**
     * @param string $abbreviation
     * @return string
     * @throws ErrorException
     */
    public static function getAbbreviation(string $abbreviation): string
    {
        $abbreviation = trim($abbreviation);
        if (!$abbreviation) {
            throw new ErrorException('Параметр "abbreviation" не определен');
        }
        return addcslashes($abbreviation, "'");
    }

    /**
     * @param string $propertyTypeId
     * @return int
     * @throws ErrorException
     */
    public static function getPropertyTypeId(string $propertyTypeId): int
    {
        $propertyTypeId = (int) $propertyTypeId;
        if (!$propertyTypeId) {
            throw new ErrorException('Параметр "property-type" не определен');
        }
        return $propertyTypeId;
    }

    /**
     * @param string $measurementId
     * @return int|null
     */
    public static function getMeasurementId(string $measurementId): ?int
    {
        return ((int) $measurementId) ?: null;
    }

    /**
     * @param string $buildingId
     * @return int
     * @throws ErrorException
     */
    public static function getBuildingId(string $buildingId): int
    {
        $buildingId = (int) $buildingId;
        if (!$buildingId) {
            throw new ErrorException('Параметр "building" не определен');
        }
        return $buildingId;
    }

    /**
     * @param string $roomCategoryId
     * @return int
     * @throws ErrorException
     */
    public static function getRoomCategoryId(string $roomCategoryId): int
    {
        $roomCategoryId = (int) $roomCategoryId;
        if (!$roomCategoryId) {
            throw new ErrorException('Параметр "room_category_id" не определен');
        }
        return $roomCategoryId;
    }

    /**
     * @param string $number
     * @return string
     * @throws ErrorException
     */
    public static function getNumber(string $number): string
    {
        $number = trim($number);
        if (!$number) {
            throw new ErrorException('Параметр "number" не определен');
        }
        return addcslashes(mb_strtolower($number), "'");
    }

    /**
     * @param string $title
     * @return string|null
     */
    public static function getTitle(string $title): ?string
    {
        return addcslashes(trim($title), "'") ?: null;
    }

    /**
     * @param string $floor
     * @return int
     */
    public static function getFloor(string $floor): int
    {
        return (int) $floor;
    }

    /**
     * @param string $area
     * @param bool $require
     * @return int
     * @throws ErrorException
     */
    public static function getArea(string $area, bool $require=false): int
    {
        $area = (int) $area;
        if ($require && !$area) {
            throw new ErrorException('Параметр "area" не определен');
        }
        return $area;
    }

    /**
     * @param string $path
     * @return string|null
     */
    public static function getPath(string $path): ?string
    {
        return addcslashes(trim($path), "'") ?: null;
    }

    /**
     * @param string $sortorder
     * @return int
     */
    public static function getSortorder(string $sortorder): int
    {
        return (int) $sortorder;
    }

    /**
     * @param string $softwareCategoryId
     * @return int|null
     */
    public static function getSoftwareCategoryId(string $softwareCategoryId): ?int
    {
        return ((int) $softwareCategoryId) ?: null;
    }

    /**
     * @param string $licenseNumber
     * @return string
     * @throws ErrorException
     */
    public static function getLicenseNumber(string $licenseNumber): string
    {
        $licenseNumber = trim($licenseNumber);
        if (!$licenseNumber) {
            throw new ErrorException('Параметр "license-number" не определен');
        }
        return addcslashes($licenseNumber, "'");
    }

    /**
     * @param string $contractNumber
     * @return string
     * @throws ErrorException
     */
    public static function getContractNumber(string $contractNumber): string
    {
        $contractNumber = trim($contractNumber);
        if (!$contractNumber) {
            throw new ErrorException('Параметр "contract-number" не определен');
        }
        return addcslashes($contractNumber, "'");
    }

    /**
     * @param string $licenseCategoryId
     * @return int|null
     */
    public static function getLicenseCategoryId(string $licenseCategoryId): ?int
    {
        return ((int) $licenseCategoryId) ?: null;
    }

    /**
     * @param string $expirationDate Формат даты: "2019-10-18",
     * такая дата приходит в массиве через AJAX
     * @return string|null
     * @throws ErrorException
     */
    public static function getExpirationDate(string $expirationDate): ?string
    {
        $pattern = '/^\d{4}-\d{2}-\d{2}$/';

        $expirationDate = trim($expirationDate);
        if (!$expirationDate) {
            return null;
        }

        if (!preg_match($pattern, $expirationDate)) {
            throw new ErrorException('Формат времени поля "Срок действия лицензии" указан неверно');
        }
        return $expirationDate;
    }

    /**
     * @param string $productionDate
     * @return int|null
     * @throws ErrorException
     */
    public static function getProductionDate(string $productionDate): ?int
    {
        $pattern = '/^\d{4}-\d{2}-\d{2}$/';

        $productionDate = trim($productionDate);
        if (!$productionDate) {
            return null;
        }

        if (!preg_match($pattern, $productionDate)) {
            throw new ErrorException('Формат времени поля "Дата производства" указан неверно');
        }
        return strtotime($productionDate) ?: null;
    }

    /**
     * @param string $productionDate
     * @return int|null
     * @throws ErrorException
     */
    public static function getProductionDateAlt(string $productionDate): ?int
    {
        $pattern = '/^\d{2}\.\d{2}\.\d{4}$/';

        $productionDate = trim($productionDate);
        if (!$productionDate) {
            return null;
        }

        if (!preg_match($pattern, $productionDate)) {
            throw new ErrorException('Формат времени поля "Дата производства" указан неверно');
        }
        return strtotime($productionDate) ?: null;
    }

    /**
     * @param string $registrationDate
     * @return int|null
     * @throws ErrorException
     */
    public static function getRegistrationDate(string $registrationDate): ?int
    {
        $pattern = '/^\d{4}-\d{2}-\d{2}$/';

        $registrationDate = trim($registrationDate);
        if (!$registrationDate) {
            return null;
        }

        if (!preg_match($pattern, $registrationDate)) {
            throw new ErrorException('Формат времени поля "Дата регистрации" указан неверно');
        }
        return strtotime($registrationDate) ?: null;
    }

    /**
     * @param string $registrationDate
     * @return int|null
     * @throws ErrorException
     */
    public static function getRegistrationDateAlt(string $registrationDate): ?int
    {
        $pattern = '/^\d{2}\.\d{2}\.\d{4}$/';

        $registrationDate = trim($registrationDate);
        if (!$registrationDate) {
            return null;
        }

        if (!preg_match($pattern, $registrationDate)) {
            throw new ErrorException('Формат времени поля "Дата регистрации" указан неверно');
        }
        return strtotime($registrationDate) ?: null;
    }

    /**
     * @param string $isDomestic
     * @return int
     */
    public static function getIsDomestic(string $isDomestic): int
    {
        return ((int) $isDomestic) ? 1 : 0;
    }

    /**
     * @param string $staffId
     * @param bool $require
     * @return int
     * @throws ErrorException
     */
    public static function getStaffId(string $staffId, bool $require=true): ?int
    {
        $staffId = (int) $staffId;
        if ($require && !$staffId) {
            throw new ErrorException('Параметр "staff_id" не определен');
        }
        return $staffId ?: null;
    }
}









