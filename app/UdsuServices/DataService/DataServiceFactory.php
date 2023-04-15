<?php
/**
 * С помощью Небес!
 *
 * @copyright   2021 Ivan Novostruev emsitef@gmail.com
 */

namespace App\UdsuServices\DataService;

use App\UdsuServices\UdsuConfig;
use App\UdsuServices\DataConverter\DataConverter;
use App\UdsuServices\DataDecoder\DataDecoderFactory;
use App\UdsuServices\DataTypeValidator\DataTypeValidator;
use App\UdsuServices\Exceptions\ConfigException;
use App\UdsuServices\Exceptions\DataConverterException;
use App\UdsuServices\Exceptions\DataDecoderException;
use App\UdsuServices\Exceptions\DataServiceException;
use App\UdsuServices\Exceptions\DataTypeValidatorException;
use App\UdsuServices\Exceptions\UdsuServicesException;
use App\UdsuServices\Request\RequestFactory;

class DataServiceFactory
{
    const AUTH = 'auth';
    const USER_DATA = 'user_data';

    /**
     * @var array
     */
    private static array $config = [];

    /**
     * @param string $serviceName
     * @return DataService
     * @throws ConfigException
     * @throws DataServiceException
     * @throws UdsuServicesException
     */
    public static function create(string $serviceName): DataService
    {
        self::init();

        $serviceConfig = self::getServiceConfig($serviceName);

        try {
            $request = RequestFactory::create($serviceName, $serviceConfig);
            $decoder = DataDecoderFactory::create($serviceConfig);
            $converter = DataConverter::create($serviceConfig);
            $validator = DataTypeValidator::create($serviceConfig);
        } catch (DataConverterException | DataTypeValidatorException | DataDecoderException $e) {
            throw new DataServiceException($e->getMessage());
        }
        return new DataService($request, $decoder, $converter, $validator);
    }

    /**
     * @throws ConfigException
     */
    private static function init(): void
    {
        if (empty(self::$config)) {
            self::$config = UdsuConfig::get(self::class);
        }
    }

    /**
     * @param string $serviceName
     * @return array
     * @throws DataServiceException
     */
    private static function getServiceConfig(string $serviceName): array
    {
        if (empty(self::$config[$serviceName])) {
            throw new DataServiceException('Data service parameters not defined');
        }
        return self::$config[$serviceName];
    }
}
