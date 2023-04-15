<?php
/**
 * С помощью Небес!
 *
 * @copyright   2021 Ivan Novostruev emsitef@gmail.com
 */

namespace App\UdsuServices;

use stdClass;

/**
 *
 * object(SimpleXMLElement)#48 (5) {
 *      ["pers_id"] => array(2) {
 *          [0]     => string(6) "144793"
 *          [1]     => string(6) "144793"
 *      }
 *      ["cookie"]  => string(32) "A6017E369D52369E94F54DCF4E102DAA"
 *      ["fio"]     => string(54) "Иванов Иван Иванович"
 *      ["roles"]   => string(20) ",СОТРУДНИК,"
 *      ["doc_id"]  => string(7) "2499212"
 * }
 */
class Auth
{
    /**
     * @var string|null
     */
    private ?string $persId;

    /**
     * @var string|null
     */
    private ?string $cookie;

    /**
     * @var string|null
     */
    private ?string $fio;

    /**
     * @var string|null
     */
    private ?string $roles;

    /**
     * @var string Логин пользователя, введённый при входе в Систему
     */
    protected string $username;

    /**
     * @var string Пароль пользователя, введённый при входе в Систему
     */
    protected string $password;

    /**
     * @param stdClass $data
     */
    public function __construct(stdClass $data)
    {
        $this->setUsername($data);
        $this->setPassword($data);
        $this->setPersId($data);
        $this->setCookie($data);
        $this->setFio($data);
        $this->setRoles($data);
    }

    /**
     * @param stdClass $data
     */
    public function setUsername(stdClass $data): void
    {
        $this->username = $data->username;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param stdClass $data
     */
    public function setPassword(stdClass $data): void
    {
        $this->password = $data->password;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param stdClass $data
     */
    public function setPersId(stdClass $data): void
    {
        $this->persId = $data->pers_id ?? null;
    }

    /**
     * @return string|null
     */
    public function getPersId(): ?string
    {
        return $this->persId;
    }

    /**
     * @param stdClass $data
     */
    public function setCookie(stdClass $data): void
    {
        $this->cookie = $data->cookie ?? null;
    }

    /**
     * @return string|null
     */
    public function getCookie(): ?string
    {
        return $this->cookie;
    }

    /**
     * @param stdClass $data
     */
    public function setFio(stdClass $data): void
    {
        $this->fio = $data->fio ?? null;
    }

    /**
     * @return string|null
     */
    public function getFio(): ?string
    {
        return $this->fio;
    }

    /**
     * @param stdClass $data
     */
    public function setRoles(stdClass $data): void
    {
        $this->roles = $data->roles ?? null;
    }

    /**
     * @return string|null
     */
    public function getRoles(): ?string
    {
        return $this->roles;
    }

    /**
     * Проверка, прошёл ли пользователь аутентификацию в ИИАС,
     * осуществляемая по наличию куки в объекте $result_iias_auth
     * !empty($this->result_iias_auth->cookie)
     *
     * @return bool
     */
    public function isAuthenticated(): bool
    {
        return !empty($this->cookie);
    }
}
