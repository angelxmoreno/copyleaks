<?php
namespace Axm\CopyLeaks\Exceptions;

/**
 * Class CopyLeaksApiException
 * @package Axm\CopyLeaks\Exceptions
 */
class CopyLeaksApiException extends ExceptionBase
{
    /**
     * @var string
     */
    protected $msg_tpl = "Api call returned an error: '%s'";
}