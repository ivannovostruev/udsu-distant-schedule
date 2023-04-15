<?php
/**
 * С помощью Небес!
 *
 * @copyright   2021 Ivan Novostruev emsitef@gmail.com
 */

namespace App\UdsuServices;

use App\UdsuServices\DataService\DataService;
use App\UdsuServices\DataService\DataServiceFactory;
use App\UdsuServices\Exceptions\ConfigException;
use App\UdsuServices\Exceptions\DataServiceException;
use App\UdsuServices\Exceptions\UdsuServicesException;
use ErrorException;
use stdClass;

class UdsuServices
{
    protected ?Auth $auth = null;
    protected ?User $user = null;

    /**
     * @param stdClass $data
     */
    public function setAuth(stdClass $data): void
    {
        $this->auth = new Auth($data);
    }

    /**
     * @return Auth
     */
    public function getAuth(): Auth
    {
        return $this->auth;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param array $params
     * @return static
     */
    public static function auth(array $params): self
    {
        $udsuServices = new self();
        try {
            $authData = self::getAuthData($params);
            $udsuServices->setAuth($authData);
        } catch (UdsuServicesException | ConfigException | DataServiceException $e) {
            exit($e->getMessage());
        }
        return $udsuServices;
    }

    /**
     * @return User|null
     */
    public function user(): ?User
    {
        $auth = $this->getAuth();
        if (!$auth->isAuthenticated()) {
            return null;
        }

        try {
            $userData = self::getUserData(['pers_id' => $auth->getPersId()]);
            $user = self::makeUser($userData);
            $user->setUsername($auth->getUsername());
            $user->setPassword($auth->getPassword());
        } catch (UdsuServicesException | ConfigException | DataServiceException $e) {
            return null;
        }
        return $user;
    }


    /**
     * @param stdClass $data
     * @return User|null
     */
    public static function makeUser(stdClass $data): ?User
    {
        try {
            $user = new User($data);
        } catch (ErrorException $e) {
            return null;
        }
        return $user;
    }

    /**
     * @param string $dataServiceName
     * @return DataService
     * @throws UdsuServicesException
     * @throws Exceptions\ConfigException
     * @throws Exceptions\DataServiceException
     */
    public static function getDataService(string $dataServiceName): DataService
    {
        return DataServiceFactory::create($dataServiceName);
    }

    /**
     * @return DataService
     * @throws UdsuServicesException
     * @throws Exceptions\ConfigException
     * @throws Exceptions\DataServiceException
     */
    public static function getAuthService(): DataService
    {
        return self::getDataService('auth');
    }

    /**
     * @return DataService
     * @throws UdsuServicesException
     * @throws Exceptions\ConfigException
     * @throws Exceptions\DataServiceException
     */
    public static function getUserService(): DataService
    {
        return self::getDataService('user_data');
    }

    /**
     * @param array $params
     * @return bool
     * @throws Exceptions\ConfigException
     * @throws Exceptions\DataServiceException
     */
    public function authenticate(array $params = []): bool
    {
        try {
            $this->setAuth(self::getAuthData($params));
        } catch (UdsuServicesException $e) {
            return false;
        }
        return $this->isAuthenticated();
    }

    /**
     * @return bool
     */
    public function isAuthenticated(): bool
    {
        return isset($this->auth) && $this->auth->isAuthenticated();
    }

    /**
     * @param array $params
     * @return stdClass
     * @throws UdsuServicesException
     * @throws Exceptions\ConfigException
     * @throws Exceptions\DataServiceException
     */
    public static function getAuthData(array $params = []): stdClass
    {
        $username = $params['username'];
        $password = $params['password'];

        $authService = self::getDataService(DataServiceFactory::AUTH);
        $authData = $authService->getData($params);
        $authData = Helper::convertSimpleXmlElementToStdClass($authData);

        $authData->username = $username;
        $authData->password = $password;

        return $authData;
    }

    /**
     * @param array $params
     * @return stdClass
     * @throws UdsuServicesException
     * @throws Exceptions\ConfigException
     * @throws Exceptions\DataServiceException
     */
    public static function getUserData(array $params = []): stdClass
    {
        $userDataService = self::getDataService(DataServiceFactory::USER_DATA);
        $userData = $userDataService->getData($params);
        return Helper::convertSimpleXmlElementToStdClass($userData);
    }

    /**
     * Обновляет пользователя Laravel, а также
     * обеспечивает уникальность пользователей в БД Moodle
     * Обеспечение уникальности пользователей осуществляется за счёт
     * проверки их персональных идентификаторов (поле idNumber в таблице 'user')
     *
     * Обновление соответствующей записи из таблицы 'user'
     *
     * @param stdClass $laravelUser
     * @param User $user
     * @return void
     * @throws UdsuServicesException
     */
    protected function refreshUser(stdClass $laravelUser, User $user): void
    {
        $userData = $user->getDataInArray();

        if (empty($existingLaravelUser = $this->getExistingLaravelUser($user))) {
            // Случай #1: Пользователь вошёл в систему В ПЕРВЫЙ РАЗ!
            $this->overrideLaravelUser($laravelUser, $laravelUser, $userData);
        } else {
            // Случай #2: Пользователь ПОВТОРНО вошёл в систему
            unset($userData['email']); // защита от перезаписи email при повторном входе

            if ($laravelUser->id === $existingLaravelUser->id) {
                // Случай #2-1: Пользователь входит в систему с ПРЕЖНИМ логином
                $this->updateLaravelUser($existingLaravelUser, $userData);
            } else {
                // Случай #2-2: Пользователь входит в систему под НОВЫМ логином
                $this->protectAgainstUserDuplicates(
                    $laravelUser,
                    $existingLaravelUser,
                    $userData
                );
            }
        }
    }

    /**
     * @param User $user
     * @return false|mixed|stdClass|null
     */
    protected function getExistingLaravelUser(User $user)
    {
        return $this->getLaravelUser('idnumber', $user->getIdNumber());
    }

    /**
     * Защититься от дублей пользователя
     *
     * Необходимо удалить текущего пользователя из БД,
     * чтобы затем переписать его объект
     * обновленным объектом существующего пользователя
     *
     * @param stdClass $laravelUser
     * @param stdClass $existingLaravelUser
     * @param array $userData
     * @throws UdsuServicesException
     */
    protected function protectAgainstUserDuplicates(
        stdClass $laravelUser,
        stdClass $existingLaravelUser,
        array    $userData
    ): void
    {
        $this->deleteLaravelUser($laravelUser);

        $userData['login'] = $laravelUser->username;
        $userData['password'] = $laravelUser->password;

        $this->overrideLaravelUser($laravelUser, $existingLaravelUser, $userData);
    }

    /**
     * Переписывает текущего пользователя в системе
     *
     * Метод объединяет в себе прошлое, настоящее и будущее
     *
     * @param stdClass $refreshedLaravelUser Освежаемый пользователь,
     * это текущий пользователь в системе
     * @param stdClass $existingLaravelUser Пользователь,
     * являющийся отражением освежаемого пользователя в БД
     * Иногда освежаемый пользователь может иметь отражение в БД(запись в таблице 'user')
     * с идентификатором, отличным от того, которое имеет освежаемый пользователь
     * Это сложно понять сходу.
     * Данная проблема возникла из-за того, что во внешней информационной системе
     * одному пользователю("персоне" выражаясь в терминах внешней ИС)
     * может соответствовать несколько учётных записей(пар логин-пароль)
     *
     * @param array $data
     */
    protected function overrideLaravelUser(
        stdClass $refreshedLaravelUser,
        stdClass $existingLaravelUser,
        array    $data
    ): void
    {
        $this->updateLaravelUser($existingLaravelUser, $data);
        $updatedLaravelUser = $this->getLaravelUser('id', $existingLaravelUser->id);
        Helper::overrideObjectProperties($refreshedLaravelUser, $updatedLaravelUser);
    }

    /**
     * Обновление соответствующей записи из таблицы 'user'
     *
     * @param stdClass $laravelUser
     * @param array $data
     * @throws UdsuServicesException
     */
    protected function updateLaravelUser(stdClass $laravelUser, array $data): void
    {
        $this->guardLaravelUserIdIsDefined($laravelUser);
        $this->dbi->updateUserRecord($laravelUser->id, $data);
    }

    /**
     * Удаляет запись пользователя из БД
     *
     * @param stdClass $laravelUser
     * @throws UdsuServicesException
     */
    protected function deleteLaravelUser(stdClass $laravelUser): void
    {
        $this->guardLaravelUserIdIsDefined($laravelUser);
        $this->dbi->deleteUserById($laravelUser->id);
    }

    /**
     * @param stdClass $moodleUser
     * @throws UdsuServicesException
     */
    protected function guardLaravelUserIdIsDefined(stdClass $moodleUser): void
    {
        if (empty($moodleUser->id)) {
            throw new UdsuServicesException('Moodle user ID not defined');
        }
    }
}
