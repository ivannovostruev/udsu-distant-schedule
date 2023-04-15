<?php
/**
 * С помощью Небес!
 *
 * @copyright   2021 Ivan Novostruev emsitef@gmail.com
 */

namespace App\UdsuServices;

use App\UdsuServices\Exceptions\ConfigException;

class UdsuConfig
{
    const CONFIG_DIR_NAME = 'config';

    /**
     * @var array Хранилище/кеш конфигов
     */
    private static array $storage = [];

    /**
     * Returns config by key
     *
     * @param string $key
     * @return array
     * @throws ConfigException
     */
    public static function get(string $key): array
    {
        $allConfigs = self::fetch();
        self::guardConfigIsFound($key, $allConfigs);

        $config = $allConfigs[$key];

        //TODO: заменить на одну проверку: и на пустоту и на массив
        self::guardConfigIsNotEmpty($config);
        self::guardConfigIsArray($config);

        return $config;
    }

    /**
     * Returns all configs
     *
     * @return array
     * @throws ConfigException
     */
    public static function fetch(): array
    {
        if (empty(self::$storage)) {
            self::load();
        }
        return self::$storage;
    }

    /**
     * This method is run only once!
     *
     * @throws ConfigException
     */
    private static function load(): void
    {
        $configs = array_map(
            function ($file) {
                return require $file;
            },
            self::getConfigFilesList()
        );
        $config = array_merge_recursive(...$configs);
        self::guardConfigIsNotEmpty($config);

        self::$storage = $config;
    }

    /**
     * @return array
     * @throws ConfigException
     */
    private static function getConfigFilesList(): array
    {
        //$pattern = self::getPathToConfigDir() . DIRECTORY_SEPARATOR . '*.php';
        $pattern = self::getPathToConfigDir() . DIRECTORY_SEPARATOR . 'data_services.php';

        if (!$list = glob($pattern)) {
            throw new ConfigException('No configuration files found');
        }
        return $list;
    }

    /**
     * @return string
     */
    private static function getPathToConfigDir(): string
    {
        return self::getRootDir();
    }

    /**
     * @return string
     */
    private static function getRootDir(): string
    {
        return __DIR__;
    }

    /**
     * @param $config
     * @throws ConfigException
     */
    private static function guardConfigIsNotEmpty($config): void
    {
        if (empty($config)) {
            throw new ConfigException('Config is empty');
        }
    }

    /**
     * @param string $key
     * @param array $configs
     * @throws ConfigException
     */
    private static function guardConfigIsFound(string $key, array $configs)
    {
        if (!array_key_exists($key, $configs)) {
            throw new ConfigException('Config by key not found');
        }
    }

    /**
     * @param $config
     * @throws ConfigException
     */
    private static function guardConfigIsArray($config): void
    {
        if (!is_array($config)) {
            throw new ConfigException('Config file data is not an array');
        }
    }

    /**
     * @param string $fileName
     * @throws ConfigException
     */
    private static function guardConfigFileExists(string $fileName): void
    {
        if (!file_exists($fileName)) {
            throw new ConfigException('Configuration file "' . $fileName . '" not found');
        }
    }
}
