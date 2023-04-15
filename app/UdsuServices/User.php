<?php
/**
 * С помощью Небес!
 *
 * @copyright   2021 Ivan Novostruev emsitef@gmail.com
 */

namespace App\UdsuServices;

use ErrorException;
use Illuminate\Support\Facades\Hash;
use stdClass;

class User
{
    private string $username;
    private string $password;

    private int $idNumber;
    private string $firstName;
    private string $lastName;
    private string $middleName;
    private ?stdClass $fio;
    private string $email;
    private array $roles = [];
    private ?string $fakePassword;

    /**
     * @param stdClass $data
     * @throws ErrorException
     */
    public function __construct(stdClass $data)
    {
        $data = $this->extractDataFromRow($data);

        $this->setIdNumber($data);
        $this->setFio($data);
        $this->setFirstName($this->fio);
        $this->setLastName($this->fio);
        $this->setMiddleName($this->fio);
        $this->setEmail($data);
        $this->setRoles($data);
        $this->setFakePassword();
    }

    /**
     * @param stdClass $data
     * @return stdClass
     * @throws ErrorException
     */
    private function extractDataFromRow(stdClass $data): stdClass
    {
        $data = $data->ROW ?? null;
        $this->guardDataFromRowIsNotEmpty($data);
        $this->guardDataFromRowIsStdClass($data);
        return $data;
    }

    /**
     * @return array
     */
    public function getDataInArray(): array
    {
        return [
            'firstname'     => $this->getFirstName(),
            'lastname'      => $this->getLastName(),
            'middlename'    => $this->getMiddleName(),
            'email'         => $this->getEmail(),
            'idnumber'      => $this->getIdNumber(),
        ];
    }

    /**
     * @param stdClass $data
     * @throws ErrorException
     */
    public function setIdNumber(stdClass $data): void
    {
        $persId = $data->PERS_ID ?? null;
        $this->guardPersIdIsDefined($persId);
        $this->idNumber = (int) $persId;
    }

    /**
     * @return int
     */
    public function getIdNumber(): int
    {
        return $this->idNumber;
    }

    /**
     * @param stdClass|null $data
     */
    public function setFirstName(?stdClass $data): void
    {
        $this->firstName = !empty($data->NAME)
            ? trim($data->NAME)
            : $this->getDefaultFirstName();
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param stdClass|null $data
     */
    public function setLastName(?stdClass $data): void
    {
        $this->lastName = !empty($data->FAMILY)
            ? trim($data->FAMILY)
            : $this->getDefaultLastName();
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param stdClass $data
     */
    public function setMiddleName(stdClass $data): void
    {
        $this->middleName = $data->PATRONYMIC ?? '';
    }

    /**
     * @return string
     */
    public function getMiddleName(): string
    {
        return $this->middleName;
    }

    /**
     * @param stdClass $data
     */
    public function setFio(stdClass $data)
    {
        $this->fio = !empty($data->FIO_FULL) && ($data->FIO_FULL instanceof stdClass)
            ? $data->FIO_FULL
            : null;
    }

    /**
     * @return stdClass|null
     */
    public function getFio(): ?stdClass
    {
        return $this->fio;
    }

    /**
     * @param stdClass $data
     */
    public function setEmail(stdClass $data): void
    {
        $dummyEmail = abs($this->idNumber) . '@udsu.ru';
        if (empty($data->EMAIL)) {
            $this->email = $dummyEmail;
        } else {
            $email = trim(mb_strtolower($data->EMAIL));
            $this->email = filter_var($email, FILTER_VALIDATE_EMAIL) ?: $dummyEmail;
        }
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param stdClass $data
     */
    public function setRoles(stdClass $data): void
    {
        $this->roles = !empty($data->ROLES)
            ? explode(',', trim($data->ROLES, ','))
            : [];
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @return bool
     */
    public function isTeacher(): bool
    {
        return in_array('ПРЕПОДАВАТЕЛЬ', $this->roles);
    }

    /**
     * @return bool
     */
    public function isStudent(): bool
    {
        return in_array('СТУДЕНТ', $this->roles);
    }

    private function setFakePassword()
    {
        $this->fakePassword = $this->idNumber
            ? Hash::make((string) $this->idNumber)
            : Hash::make('udsuvudsu');
    }

    /**
     * @return string|null
     */
    public function getFakePassword(): ?string
    {
        return $this->fakePassword;
    }

    public function getName(): string
    {
        return $this->lastName . ' ' . $this->firstName . ' ' . $this->middleName;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    protected function getDefaultFirstName(): string
    {
        return 'User' . abs($this->idNumber);
    }

    /**
     * @return string
     */
    protected function getDefaultLastName(): string
    {
        return 'User';
    }

    /**
     * @param $element
     * @throws ErrorException
     */
    private function guardDataFromRowIsNotEmpty($element): void
    {
        if (empty($element)) {
            throw new ErrorException('IIAS: Данные о пользователе пусты');
        }
    }

    /**
     * @param $element
     * @throws ErrorException
     */
    private function guardDataFromRowIsStdClass($element): void
    {
        if (!$element instanceof stdClass) {
            throw new ErrorException('IIAS: Элемент ROW не является экземпляром стандартного класса');
        }
    }

    /**
     * @param string|null $persId
     * @throws ErrorException
     */
    private function guardPersIdIsDefined(?string $persId): void
    {
        if (empty($persId)) {
            throw new ErrorException('IIAS: Персональный идентификатор пользователя не определен');
        }
    }
}
