<?php
namespace Axm\CopyLeaks\Request;

use Axm\CopyLeaks\Response\Response;
use Requests;

/**
 * Class RequestsAdapter
 * @package Axm\CopyLeaks\Request
 */
class RequestsAdapter extends RequestBase
{
    /**
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return Response
     */
    public function post($url, $data = [], $headers = [])
    {
        $response = Requests::post($url, $headers, $data);
        $body = $response->headers->getValues('copyleaks-error-code')
            ? ['Message' => $response->body]
            : $this->decodeJson($response->body);

        return Response::build($response->status_code, $response->success, $body);
    }

    /**
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return Response
     */
    public function get($url, $data = [], $headers = [])
    {
        $url = $data
            ? $url . '?' . http_build_query($data)
            : $url;
        $response = Requests::get($url, $headers);
        if ($response->headers->getValues('copyleaks-error-code')) {
            $body = ['Message' => $response->body];
        } elseif ($this->isJson($response->body)) {
            $body = $this->decodeJson($response->body);
        } else {
            $body = [$response->body];
        }

        return Response::build($response->status_code, $response->success, $body);
    }
}