<?php
namespace Axm\CopyLeaks\Request;

use Axm\CopyLeaks\Response\Response;

/**
 * Interface RequestInterface
 * @package Axm\CopyLeaks\Request
 */
interface RequestInterface
{
    /**
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return Response
     */
    public function post($url, $data = [], $headers = []);
}
