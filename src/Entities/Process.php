<?php
namespace Axm\CopyLeaks\Entities;

use Axm\CopyLeaks\Response\Response;
use Cake\Utility\Hash;
use Rakshazi\GetSetTrait;

/**
 * Class Process
 * @package Axm\CopyLeaks\Entities
 *
 * @method string getId()
 * @method void setId(string $id)
 * @method \DateTimeInterface getCreated()
 * @method int getEtaSeconds()
 * @method void setEtaSeconds(int $eta_seconds)
 * @method array getCustomFields()
 * @method void setCustomFields(array $custom_fields)
 */
class Process
{
    use GetSetTrait;

    const DATE_TIME_FORMAT = 'd/m/Y H:i:s';

    /**
     * @var string
     */
    protected $id;

    /**
     * @var \DateTimeInterface
     */
    protected $created;

    /**
     * @var int
     */
    protected $eta_seconds;

    /**
     * @var array
     */
    protected $custom_fields = [];

    /**
     * @param Response $response
     *
     * @return Process
     */
    public static function createFromResponse(Response $response)
    {
        $instance = new self();
        $instance->setId($response->getBodyProperty('ProcessId'));
        $instance->setCreated($response->getBodyProperty('CreationTimeUTC'));
        $instance->setEtaSeconds($response->getBodyProperty('EstimatedTimePerCredit'));
        $instance->setEtaSeconds($response->getBodyProperty('EstimatedTimePerCredit'));

        return $instance;
    }

    /**
     * @param $date
     */
    public function setCreated($date)
    {
        $this->created = ($date instanceof \DateTimeInterface)
            ? $date
            : \DateTime::createFromFormat(self::DATE_TIME_FORMAT, $date);
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function getCustomField($key, $default = null)
    {
        return Hash::get($this->getCustomFields(), $key, $default);
    }
}
