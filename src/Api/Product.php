<?php
namespace Axm\CopyLeaks\Api;

use Axm\CopyLeaks\Collections\ProcessesCollection;
use Axm\CopyLeaks\Collections\ResultsCollection;
use Axm\CopyLeaks\Entities\Process;
use Axm\CopyLeaks\ProductEndPoints;
use Axm\CopyLeaks\Response\Response;

/**
 * Trait Product
 * @package Axm\CopyLeaks\Api
 *
 * @method string getApiProduct()
 * @method Response buildRequest(string $type, string $uri, array $params = [], array $headers = [])
 * @method Response buildAuthenticatedRequest(string $type, string $uri, array $params = [], array $headers = [])
 */
trait Product
{
    /**
     * @param string $url
     * @return mixed
     * @throws \Axm\CopyLeaks\Exceptions\InvalidProductException
     */
    public function createByUrl($url)
    {
        $call = ProductEndPoints::getCallDetails($this->getApiProduct(), 'create-by-url');
        $params = [
            'Url' => $url
        ];
        $response = $this->buildAuthenticatedRequest($call->type, $call->uri, $params);

        return Process::createFromResponse($response);
    }

    /**
     * @param string $text
     *
     * @return Process
     *
     * @throws \Axm\CopyLeaks\Exceptions\InvalidProductException
     */
    public function createByText($text)
    {
        $call = ProductEndPoints::getCallDetails($this->getApiProduct(), 'create-by-text');
        $params = [
            'text' => $text
        ];
        $response = $this->buildAuthenticatedRequest($call->type, $call->uri, $params);

        return Process::createFromResponse($response);
    }

    /**
     * @param string $process_id
     *
     * @return Process
     *
     * @throws \Axm\CopyLeaks\Exceptions\InvalidProductException
     */
    public function status($process_id)
    {
        $call = ProductEndPoints::getCallDetails($this->getApiProduct(), 'status');
        $uri = str_replace('{ProcessId}', $process_id, $call->uri);
        $response = $this->buildAuthenticatedRequest($call->type, $uri);

        return $response->getBodyProperty('ProgressPercents');
    }

    /**
     * @param string $process_id
     *
     * @return ResultsCollection
     *
     * @throws \Axm\CopyLeaks\Exceptions\InvalidProductException
     */
    public function result($process_id)
    {
        $call = ProductEndPoints::getCallDetails($this->getApiProduct(), 'result');
        $uri = str_replace('{ProcessId}', $process_id, $call->uri);
        $response = $this->buildAuthenticatedRequest($call->type, $uri);

        return ResultsCollection::createFromResponse($response);
    }

    /**
     * @return ProcessesCollection
     *
     * @throws \Axm\CopyLeaks\Exceptions\InvalidProductException
     */
    public function getActiveProcesses()
    {
        $call = ProductEndPoints::getCallDetails($this->getApiProduct(), 'list');
        $response = $this->buildAuthenticatedRequest($call->type, $call->uri);

        return ProcessesCollection::createFromResponse($response);
    }
}