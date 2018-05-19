<?php
namespace Axm\CopyLeaks\Exceptions;

use Rakshazi\GetSetTrait;

/**
 * Class ExceptionBase
 * @package Axm\CopyLeaks\Exceptions
 *
 * @method array getAttributes()
 * @method void setAttributes(array $attributes)
 * @method string getMsgTpl()
 * @method void setMsgTpl(string $msg_tpl)
 * @method int getCode()
 * @method void setCode(int $code)
 */
abstract class ExceptionBase extends \Exception
{
    use GetSetTrait;

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @var string
     */
    protected $msg_tpl = '';

    /**
     * @var int
     */
    protected $code = 500;

    /**
     * ExceptionBase constructor.
     * @param array|string $message
     * @param int $code
     * @param null $previous
     */
    public function __construct($message = '', $code = 500, $previous = null)
    {
        if (is_array($message)) {
            $this->setAttributes($message);
            $message = vsprintf($this->getMsgTpl(), $this->getAttributes());
        }
        parent::__construct($message, $code, $previous);
    }
}
