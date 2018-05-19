<?php
namespace Axm\CopyLeaks\Api;

use Axm\CopyLeaks\Constants;
use Axm\CopyLeaks\Response\Response;

/**
 * Trait Account
 * @package Axm\CopyLeaks\Api
 *
 * @method Response buildRequest(string $type, string $uri, array $params)
 */
trait Account
{
    /**
     * @return string
     *
     */
    public function login()
    {
        $type = Constants::HTTP_POST;
        $uri = Constants::URI_LOGIN;
        $params = [
            'Email' => $this->getApiEmail(),
            'ApiKey' => $this->getApiKey(),
        ];
        $response = $this->buildRequest($type, $uri, $params);
        $access_token = $response->getBodyProperty('access_token');
        $this->setAccessToken($access_token);

        return $this->getAccessToken();
    }
}