<?php
namespace Axm\CopyLeaks\Exceptions;

use Axm\CopyLeaks\Response\Response;

/**
 * Class UnexpectedResponseException
 * @package Axm\CopyLeaks\Exceptions
 */
class UnexpectedResponseException extends ExceptionBase
{
    /**
     * @var string
     */
    protected $msg_tpl = 'Unexpected '.Response::class.'. Got %s.';
}
