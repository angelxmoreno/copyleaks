<?php
namespace Axm\CopyLeaks\Collections;

use Axm\CopyLeaks\Entities\Result;
use Axm\CopyLeaks\Response\Response;

/**
 * Class ResultsCollection
 * @package Axm\CopyLeaks\Collections
 */
class ResultsCollection extends CollectionBase
{
    /**
     * @param Response $response
     * @return ResultsCollection
     */
    public static function createFromResponse(Response $response)
    {
        $data = $response->getBody();
        $items = [];
        foreach ($data as $datum) {
            $response = new Response();
            $response->setBody($datum);
            $items[] = Result::createFromResponse($response);
        }

        return new self($items);
    }
}