<?php
/**
 * С помощью Небес!
 *
 * @copyright   2021 Ivan Novostruev emsitef@gmail.com
 */

namespace App\UdsuServices\Request;

class UserDataRequest extends CurlRequest
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
        $persId = $params['pers_id'];
        return $this->getUrl() . $persId;
    }
}
