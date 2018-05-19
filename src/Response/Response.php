<?php
namespace Axm\CopyLeaks\Response;

/**
 * Class Response
 * @package Axm\CopyLeaks\Response
 */
class Response
{
    /**
     * @var array
     */
    protected $body = [];

    /**
     * @var int
     */
    protected $status_code = 200;

    /**
     * @var bool
     */
    protected $success = false;

    /**
     * @param int $status_code
     * @param bool $success
     * @param array $body
     * @return Response
     */
    public static function build($status_code, $success, array $body)
    {
        $response = new self();

        return $response
            ->setBody($body)
            ->setSuccess($success)
            ->setStatusCode($status_code);
    }

    public function getBodyProperty($key)
    {
        return array_key_exists($key, $this->getBody())
            ? $this->getBody()[$key]
            : null;
    }

    /**
     * @return array
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param array $body
     * @return Response
     */
    public function setBody(array $body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->status_code;
    }

    /**
     * @param int $status_code
     * @return Response
     */
    public function setStatusCode($status_code)
    {
        $this->status_code = $status_code;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @param bool $success
     * @return Response
     */
    public function setSuccess($success)
    {
        $this->success = $success;

        return $this;
    }

}