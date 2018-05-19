<?php
namespace Axm\CopyLeaks\Request;

use Axm\CopyLeaks\Exceptions\CopyLeaksApiException;
use Axm\CopyLeaks\Exceptions\UnexpectedResponseException;
use Axm\CopyLeaks\Response\Response;

/**
 * Class RequestBase
 * @package Axm\CopyLeaks\Request
 */
abstract class RequestBase implements RequestInterface
{
    /**
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return Response
     * @throws UnexpectedResponseException
     * @throws CopyLeaksApiException
     */
    public function doPost($url, $data = [], $headers = [])
    {
        $response = $this->post($url, $data, $headers);
        $this->ensureResponseType($response);
        if (!$response->isSuccess()) {
            throw new CopyLeaksApiException(
                [$response->getBodyProperty('Message')],
                $response->getStatusCode()
            );
        }

        return $response;
    }

    /**
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return Response
     * @throws UnexpectedResponseException
     * @throws CopyLeaksApiException
     */
    public function doGet($url, $data = [], $headers = [])
    {
        $response = $this->get($url, $data, $headers);
        $this->ensureResponseType($response);
        if (!$response->isSuccess()) {
            throw new CopyLeaksApiException(
                [$response->getBodyProperty('Message')],
                $response->getStatusCode()
            );
        }

        return $response;
    }

    /**
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return Response
     */
    abstract public function post($url, $data = [], $headers = []);

    /**
     * @param $url
     * @param array $data
     * @param array $headers
     * @return mixed
     */
    abstract public function get($url, $data = [], $headers = []);

    /**
     * @param $response
     * @throws UnexpectedResponseException
     */
    protected function ensureResponseType($response)
    {
        $response_class = Response::class;
        if (!($response instanceof $response_class)) {
            $error = is_object($response)
                ? get_class($response)
                : gettype($response);
            throw new UnexpectedResponseException([$error]);
        }
    }

    /**
     * @param string $json_string
     * @return array
     */
    protected function decodeJson($json_string)
    {
        $array = json_decode($json_string, true);
        if (is_array($array)) {
            return $array;
        } else {
            throw new \RuntimeException('Invalid JSON while decoding. ' . $json_string);
        }
    }

    /**
     * @param string $string
     * @return bool
     */
    protected function isJson($string)
    {
        json_decode($string);

        return (json_last_error() == JSON_ERROR_NONE);
    }
}