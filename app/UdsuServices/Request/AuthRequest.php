<?php
/**
 * С помощью Небес!
 *
 * @copyright   2021 Ivan Novostruev emsitef@gmail.com
 */

namespace App\UdsuServices\Request;

/**
 * Пример выгрузки:
 *
 * object(SimpleXMLElement) {
 *     ["pers_id"]  => string "144555"
 *     ["cookie"]   => string "5CA9F39310CB01D1EB30E41B5858919C"
 *     ["fio"]      => string "Иванов Иван Иванович"
 *     ["roles"]    => string ",СОТРУДНИК,"
 *     ["doc_id"]   => string "2499212"
 * }
 *
 */
class AuthRequest extends CurlRequest
{
    /**
     * @param $curlHandle
     * @param array $params
     */
    protected function applyOptions($curlHandle, array $params): void
    {
        curl_setopt_array($curlHandle, [
            CURLOPT_URL             => $this->getFullUrl($params),
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_CONNECTTIMEOUT  => 10,
        ]);
    }

    /**
     * @param array $params
     * @return string
     */
    protected function getFullUrl(array $params=[]): string
    {
        $pieces = explode('%', $this->url);

        $username = $params['username'];
        $password = $params['password'];

        return $pieces[0] . $username . $pieces[1] . $password . $pieces[2];
    }
}
