<?php
/**
 * С помощью Небес!
 *
 * @copyright   2021 Ivan Novostruev emsitef@gmail.com
 */

namespace App\UdsuServices\DataTypeValidator;

use App\UdsuServices\Exceptions\DataTypeValidatorException;

class DataTypeValidator
{
    const PARAM_NAME = 'data_type';

    const ALLOWED_DATA_TYPE = ['array', 'object'];

    /**
     * @var string Требуемый тип данных ответа от дата-сервиса, который берется из конфига
     */
    protected string $dataType;

    /**
     * @param string $dataType
     */
    public function __construct(string $dataType)
    {
        $this->dataType = $dataType;
    }

    /**
     * @param array $serviceConfig
     * @return static
     * @throws DataTypeValidatorException
     */
    public static function create(array $serviceConfig): self
    {
        return new self(self::getDataType($serviceConfig));
    }

    /**
     * @param array $serviceConfig
     * @return string
     * @throws DataTypeValidatorException
     */
    private static function getDataType(array $serviceConfig): string
    {
        $dataType = !empty($serviceConfig[self::PARAM_NAME])
            ? trim($serviceConfig[self::PARAM_NAME])
            : '';

        self::guardDataTypeIsDefined($dataType);
        self::guardDataTypeIsAllowed($dataType);

        return $dataType;
    }

    /**
     * @param $data
     * @throws DataTypeValidatorException
     */
    public function validate($data): void
    {
        if (!$this->checkDataType($data)) {
            throw new DataTypeValidatorException('Полученные данные имеют некорректный тип.' . PHP_EOL
                . 'Требуемый тип: ' . $this->dataType . PHP_EOL
                . 'Фактический тип: ' . gettype($data));
        }
    }

    /**
     * @param $data
     * @return bool
     */
    protected function checkDataType($data): bool
    {
        return match ($this->dataType) {
            'array'  => is_array($data),
            'object' => is_object($data),
            default  => false,
        };
    }

    /**
     * @param string|null $dataType
     * @throws DataTypeValidatorException
     */
    private static function guardDataTypeIsDefined(?string $dataType): void
    {
        if (empty($dataType)) {
            throw new DataTypeValidatorException('Тип данных, которые должен возвратить сервис, не определен');
        }
    }

    /**
     * @param string $dataType
     * @throws DataTypeValidatorException
     */
    private static function guardDataTypeIsAllowed(string $dataType): void
    {
        if (!in_array($dataType, self::ALLOWED_DATA_TYPE)) {
            throw new DataTypeValidatorException('Недопустимый тип данных');
        }
    }
}
