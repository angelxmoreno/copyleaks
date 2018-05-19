<?php
namespace Axm\CopyLeaks\Exceptions;

use Axm\CopyLeaks\Constants;

/**
 * Class InvalidProductException
 * @package Axm\CopyLeaks\Exceptions
 */
class InvalidProductException extends ExceptionBase
{
    /**
     * @var string
     */
    protected $msg_tpl = '%s is not valid product. Please use one of the following: ';

    protected function getMsgTpl()
    {
        return $this->msg_tpl . implode(', ', Constants::VALID_PRODUCTS);
    }
}