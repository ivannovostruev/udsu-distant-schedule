<?php
/**
 * С помощью Небес!
 *
 * @copyright   2021 Ivan Novostruev emsitef@gmail.com
 */

namespace App\UdsuServices\DataDecoder;

use App\UdsuServices\Exceptions\DataDecoderException;

class JsonDataDecoder implements DataDecoder
{
    /**
     * @param $data
     * @return mixed
     * @throws DataDecoderException
     */
    public function decode($data)
    {
        $data = json_decode($data);
        self::guardJsonDecodeIsSuccess($data);
        return $data;
    }

    /**
     * @param $data
     * @throws DataDecoderException
     */
    private static function guardJsonDecodeIsSuccess($data): void
    {
        if ($data === null) {
            throw new DataDecoderException('Не удалось преобразовать данные в json');
        }
    }
}
