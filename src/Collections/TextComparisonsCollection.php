<?php
namespace Axm\CopyLeaks\Collections;

use Axm\CopyLeaks\Entities\TextComparison;
use Axm\CopyLeaks\Response\Response;

/**
 * Class TextComparisonsCollection
 * @package Axm\CopyLeaks\Collections
 *
 * @method string getType()
 * @method void setType(string $type)
 */
class TextComparisonsCollection extends CollectionBase
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @param array $text_comparisons
     * @param string $type
     * @return TextComparisonsCollection
     */
    public static function createFromArray(array $text_comparisons, $type)
    {
        $items = [];
        foreach ($text_comparisons as $datum) {
            $response = new Response();
            $response->setBody($datum);
            $items[] = TextComparison::createFromResponse($response);
        }
        $instance = new self($items);
        $instance->setType($type);

        return $instance;
    }
}
