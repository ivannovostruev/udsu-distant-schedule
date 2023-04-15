<?php
/**
 * С помощью Небес!
 *
 * @copyright    2021 Novostruev Ivan emsitef@gmail.com
 */

namespace App\UdsuServices\DataService;

use App\UdsuServices\DataConverter\DataConverter;
use App\UdsuServices\DataDecoder\DataDecoder;
use App\UdsuServices\DataTypeValidator\DataTypeValidator;
use App\UdsuServices\Exceptions\DataConverterException;
use App\UdsuServices\Exceptions\DataServiceException;
use App\UdsuServices\Exceptions\DataTypeValidatorException;
use App\UdsuServices\Request\Request;
use ErrorException;

/**
 * Класс предназначен для получения данных от стороннего сервиса
 */
class DataService
{
    /**
     * @var Request
     */
    protected Request $request;

    /**
     * @var DataDecoder
     */
    protected DataDecoder $decoder;

    /**
     * @var DataConverter
     */
    private DataConverter $converter;

    /**
     * @var DataTypeValidator
     */
    private DataTypeValidator $validator;

    /**
     * @param Request $request
     * @param DataDecoder $decoder
     * @param DataConverter $converter
     * @param DataTypeValidator $validator
     */
    public function __construct(
        Request $request,
        DataDecoder $decoder,
        DataConverter $converter,
        DataTypeValidator $validator
    ) {
        $this->request = $request;
        $this->decoder = $decoder;
        $this->converter = $converter;
        $this->validator = $validator;
    }

    /**
     * Метод-интерфейс
     *
     * @param array $params
     * @return mixed
     * @throws DataServiceException
     */
    public function getData(array $params = [])
    {
        try {
            $data = $this->getDataFromRequest($params);
            $data = $this->convertToUtf8($data);
            $data = $this->decode($data);
            $this->validateDataType($data);
        } catch (ErrorException | DataConverterException | DataTypeValidatorException $e) {
            throw new DataServiceException($e->getMessage());
        }
        return $data;
    }

    /**
     * @param array $params
     * @return string
     * @throws ErrorException
     */
    protected function getDataFromRequest(array $params): string
    {
        return $this->request->execute($params)->getResult();
    }

    /**
     * @param string $data
     * @return string
     * @throws DataConverterException
     */
    protected function convertToUtf8(string $data): string
    {
        return $this->converter->convert($data);
    }

    /**
     * @param string $data
     * @return mixed
     */
    protected function decode(string $data)
    {
        return $this->decoder->decode($data);
    }

    /**
     * @param $data
     * @throws DataTypeValidatorException
     */
    protected function validateDataType($data)
    {
        $this->validator->validate($data);
    }
}
