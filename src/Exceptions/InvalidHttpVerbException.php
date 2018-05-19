<?php
namespace Axm\CopyLeaks\Exceptions;

use Axm\CopyLeaks\Constants;

/**
 * Class InvalidHttpVerbException
 * @package Axm\CopyLeaks\Exceptions
 */
class InvalidHttpVerbException extends ExceptionBase
{
    /**
     * @var string
     */
    protected $msg_tpl = '%s is not valid. please use ' . Constants::HTTP_POST . ' or ' . Constants::HTTP_GET;
}