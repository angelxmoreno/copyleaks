<?php
namespace Axm\CopyLeaks\Collections;

use Axm\CopyLeaks\Entities\Process;
use Axm\CopyLeaks\Response\Response;

/**
 * Class ProcessesCollection
 * @package Axm\CopyLeaks\Collections
 */
class ProcessesCollection extends CollectionBase
{
    /**
     * @param Response $response
     * @return ProcessesCollection
     */
    public static function createFromResponse(Response $response)
    {
        $data = $response->getBody();
        $items = [];
        foreach ($data as $datum) {
            $response = new Response();
            $response->setBody($datum);

            $items[] = Process::createFromResponse($response);
        }

        return new self($items);
    }
}