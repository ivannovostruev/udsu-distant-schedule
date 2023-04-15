<?php
/**
 * С помощью Небес!
 *
 * @copyright   2021 Ivan Novostruev emsitef@gmail.com
 */

namespace App\UdsuServices\Request;

use CurlHandle;
use ErrorException;

abstract class CurlRequest implements Request
{
    /**
     * @var string
     */
    protected string $result;

    /**
     * @var string
     */
    protected string $url;

    /**
     * @param $curlHandle
     * @param array $params
     */
    abstract protected function applyOptions($curlHandle, array $params): void;

    /**
     * @param string $url
     */
    public function __construct(string $url = '')
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @param array $params
     * @return CurlRequest
     * @throws ErrorException
     */
    public function execute(array $params = []): self
    {
        $curlHandle = curl_init();
        $this->guardCurlHandleIsCorrect($curlHandle);

        $this->applyOptions($curlHandle, $params);

        $result = curl_exec($curlHandle);

        $curlErrorCode = curl_errno($curlHandle);
        $curlError = curl_error($curlHandle);

        curl_close($curlHandle);

        $this->guardCurlNoError($curlErrorCode, $curlError);
        $this->guardResultExists($result);

        $this->result = (string) $result;
        return $this;
    }

    /**
     * @return string
     */
    public function getResult(): string
    {
        return $this->result;
    }

    /**
     * @param $curlHandle
     * @throws ErrorException
     */
    protected function guardCurlHandleIsCorrect($curlHandle): void
    {
        if (!$curlHandle instanceof CurlHandle) {
            throw new ErrorException('Error when init CURL');
        }
    }

    /**
     * @param int $errorCode
     * @param string $errorText
     * @throws ErrorException
     */
    protected function guardCurlNoError(int $errorCode, string $errorText): void
    {
        if ($errorCode > 0) {
            throw new ErrorException('CURL error: ' . $errorText);
        }
    }

    /**
     * @param $result
     * @throws ErrorException
     */
    protected function guardResultExists($result): void
    {
        if (empty($result)) {
            throw new ErrorException('Request failed in class ' . static::class);
        }
    }
}
