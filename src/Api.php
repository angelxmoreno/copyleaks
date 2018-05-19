<?php
namespace Axm\CopyLeaks;

use Axm\CopyLeaks\Request\RequestBase;
use Axm\CopyLeaks\Response\Response;
use Rakshazi\GetSetTrait;

/**
 * Class Api
 * @package Axm\CopyLeaks
 *
 * @method RequestBase getHttp()
 * @method void setHttp(RequestBase $http)
 * @method string getApiEmail()
 * @method void setApiEmail(string $api_email)
 * @method string getApiKey()
 * @method void setApiKey(string $api_key)
 * @method string getApiProduct()
 * @method void setApiProduct(string $api_product)
 * @method string getAccessToken()
 * @method void setAccessToken(string $access_token)
 * @method bool getSandboxModeEnabled()
 * @method void setSandboxModeEnabled(bool $sandbox_mode_enabled)
 */
class Api
{
    use GetSetTrait;
    use Api\Account;
    use Api\Product;

    /**
     * @var RequestBase
     */
    protected $http;

    /**
     * @var string
     */
    protected $api_email = '';

    /**
     * @var string
     */
    protected $api_key = '';

    /**
     * @var string
     */
    protected $api_product = '';

    /**
     * @var string
     */
    protected $access_token;

    /**
     * @var bool
     */
    protected $sandbox_mode_enabled = true;

    /**
     * Api constructor.
     * @param RequestBase $http
     * @param string $api_email
     * @param string $api_key
     * @param string $api_product
     */
    public function __construct(RequestBase $http, $api_email, $api_key, $api_product)
    {
        $this->setHttp($http);
        $this->setApiEmail($api_email);
        $this->setApiKey($api_key);
        $this->setApiProduct($api_product);
    }

    /**
     * @param string $type
     * @param string $uri
     * @param array $params
     * @param array $headers
     *
     * @return Response
     *
     * @throws Exceptions\CopyLeaksApiException
     * @throws Exceptions\UnexpectedResponseException
     * @throws Exceptions\InvalidHttpVerbException
     */
    protected function buildRequest($type, $uri, array $params = [], array $headers = [])
    {
        if ($this->isSandboxMode()) {
            $headers['copyleaks-sandbox-mode'] = true;
        }
        $url = Constants::BASE_URL . $uri;
        switch ($type) {
            case Constants::HTTP_GET:
                $response = $this->getHttp()->doGet($url, $params, $headers);
                break;
            case Constants::HTTP_POST:
                $response = $this->getHttp()->doPost($url, $params, $headers);
                break;
            default:
                throw new Exceptions\InvalidHttpVerbException([$type]);
        }

        return $response;
    }

    /**
     * @param string $type
     * @param string $uri
     * @param array $params
     * @param array $headers
     *
     * @return Response
     *
     * @throws Exceptions\CopyLeaksApiException
     * @throws Exceptions\InvalidHttpVerbException
     * @throws Exceptions\UnexpectedResponseException
     */
    protected function buildAuthenticatedRequest($type, $uri, array $params = [], array $headers = [])
    {
        $token = $this->getAccessToken() ?: $this->login();
        $headers['Authorization'] = sprintf('Bearer %s', $token);

        return $this->buildRequest($type, $uri, $params, $headers);
    }

    /**
     * @return bool
     */
    public function isSandboxMode()
    {
        return $this->getSandboxModeEnabled();
    }

}
