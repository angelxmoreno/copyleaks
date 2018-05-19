<?php
namespace Axm\CopyLeaks;

/**
 * Class self
 * @package Axm\CopyLeaks
 */
class Constants
{
    const BASE_URL = 'https://api.copyleaks.com';
    const URI_LOGIN = '/v1/account/login-api';

    const HTTP_GET = 'get';
    const HTTP_POST = 'post';
    const HTTP_DELETE = 'delete';

    const VALID_PRODUCTS = [
        self::PRODUCT_BUSINESS
    ];
    const PRODUCT_BUSINESS = 'business';
}