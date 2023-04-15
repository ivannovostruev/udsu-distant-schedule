<?php
/**
 * С помощью Небес!
 *
 * @copyright   2021 Ivan Novostruev emsitef@gmail.com
 */

namespace App\UdsuServices\Request;

use App\UdsuServices\Exceptions\UdsuServicesException;

class RequestFactory
{
    const PARAM_NAME    = 'request_url';

    const AUTH          = 'auth';
    const USER_DATA     = 'user_data';

    const REQUEST_CLASSES = [
        self::AUTH          => AuthRequest::class,
        self::USER_DATA     => UserDataRequest::class,
    ];

    /**
     * @param string $serviceName
     * @param array $serviceConfig
     * @return Request
     * @throws UdsuServicesException
     */
    public static function create(string $serviceName, array $serviceConfig): Request
    {
        $requestUrl = self::getRequestUrl($serviceConfig);
        $requestClass = self::getRequestClass($serviceName);
        return new $requestClass($requestUrl);
    }

    /**
     * @param string $serviceName
     * @return string
     * @throws UdsuServicesException
     */
    private static function getRequestClass(string $serviceName): string
    {
        if (!isset(self::REQUEST_CLASSES[$serviceName])) {
            throw new UdsuServicesException('Request class with data service name "'
                . $serviceName . '" not defined.');
        }
        return self::REQUEST_CLASSES[$serviceName];
    }

    /**
     * @param array $serviceConfig
     * @return string
     * @throws UdsuServicesException
     */
    private static function getRequestUrl(array $serviceConfig): string
    {
        if (empty($serviceConfig[self::PARAM_NAME])) {
            throw new UdsuServicesException('Request URL not defined');
        }
        return trim($serviceConfig[self::PARAM_NAME]);
    }
}
