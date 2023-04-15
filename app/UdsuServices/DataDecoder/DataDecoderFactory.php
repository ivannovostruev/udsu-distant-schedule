<?php
/**
 * С помощью Небес!
 *
 * @copyright   2021 Ivan Novostruev emsitef@gmail.com
 */

namespace App\UdsuServices\DataDecoder;

use App\UdsuServices\Exceptions\DataDecoderException;

class DataDecoderFactory
{
    const PARAM_NAME = 'exchange_format';

    const DEFAULT_EXCHANGE_FORMAT = 'json';

    const FORMAT_XML = 'xml';
    const FORMAT_JSON = 'json';

    const DATA_DECODER_CLASSES = [
        self::FORMAT_XML    => XmlDataDecoder::class,
        self::FORMAT_JSON   => JsonDataDecoder::class,
    ];

    /**
     * @param array $serviceConfig
     * @return DataDecoder
     * @throws DataDecoderException
     */
    public static function create(array $serviceConfig): DataDecoder
    {
        $exchangeFormat = self::getExchangeFormat($serviceConfig);
        $dataDecoderClass = self::getDataDecoderClass($exchangeFormat);
        return new $dataDecoderClass();
    }

    /**
     * @param string $exchangeFormat
     * @return string
     * @throws DataDecoderException
     */
    private static function getDataDecoderClass(string $exchangeFormat): string
    {
        if (!isset(self::DATA_DECODER_CLASSES[$exchangeFormat])) {
            throw new DataDecoderException('DataDecoder class with exchange format "'
                . $exchangeFormat . '" not defined');
        }
        return self::DATA_DECODER_CLASSES[$exchangeFormat];
    }

    /**
     * @param array $serviceConfig
     * @return string
     */
    private static function getExchangeFormat(array $serviceConfig): string
    {
        return !empty($serviceConfig[self::PARAM_NAME])
            ? trim($serviceConfig[self::PARAM_NAME])
            : self::DEFAULT_EXCHANGE_FORMAT;
    }
}
