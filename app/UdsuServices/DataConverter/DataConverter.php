<?php
/**
 * С помощью Небес!
 *
 * @copyright   2021 Ivan Novostruev emsitef@gmail.com
 */

namespace App\UdsuServices\DataConverter;

use App\UdsuServices\Exceptions\DataConverterException;

class DataConverter
{
    const PARAM_NAME = 'encoding';

    const DEFAULT_SOURCE_ENCODING = 'UTF-8';

    /**
     * Исходная кодировка данных, получаемых от сервиса
     * По умолчанию - UTF-8
     *
     * @var string
     */
    protected string $sourceEncoding;

    /**
     * @param string $sourceEncoding
     */
    public function __construct(string $sourceEncoding)
    {
        $this->sourceEncoding = $sourceEncoding;
    }

    /**
     * @param array $serviceConfig
     * @return static
     * @throws DataConverterException
     */
    public static function create( array $serviceConfig): self
    {
        return new self(self::getSourceEncoding($serviceConfig));
    }

    /**
     * @param array $serviceConfig
     * @return string
     * @throws DataConverterException
     */
    private static function getSourceEncoding(array $serviceConfig): string
    {
        $sourceEncoding = !empty($serviceConfig[self::PARAM_NAME])
            ? trim($serviceConfig[self::PARAM_NAME])
            : self::DEFAULT_SOURCE_ENCODING;

        self::guardEncodingIsSupported($sourceEncoding);

        return $sourceEncoding;
    }

    /**
     * @param string $data
     * @return string
     * @throws DataConverterException
     */
    public function convert(string $data): string
    {
        if ($this->sourceEncoding === self::DEFAULT_SOURCE_ENCODING) {
            return $data;
        }
        $data = mb_convert_encoding($data, self::DEFAULT_SOURCE_ENCODING, $this->sourceEncoding);
        $this->guardDataIsConvertedToUtf8($data);
        return $data;
    }

    /**
     * @param $data
     * @throws DataConverterException
     */
    protected function guardDataIsConvertedToUtf8($data)
    {
        if ($data === false) {
            throw new DataConverterException('Не удалось преобразовать данные из кодировки "'
                . $this->sourceEncoding . '" в кодировку "'
                . self::DEFAULT_SOURCE_ENCODING . '"');
        }
    }

    /**
     * @param $encoding
     * @throws DataConverterException
     */
    private static function guardEncodingIsSupported($encoding): void
    {
        if (!in_array($encoding, mb_list_encodings(), true)) {
            throw new DataConverterException('Encoding "' . $encoding . '" not supported');
        }
    }
}
