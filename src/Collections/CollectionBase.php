<?php
namespace Axm\CopyLeaks\Collections;

use Cake\Collection\CollectionTrait;

/**
 * Class CollectionBase
 * @package Axm\CopyLeaks\Collections
 */
abstract class CollectionBase
{
    use CollectionTrait;

    /**
     * @var array
     */
    protected $items = [];

    /**
     * CollectionBase constructor.
     * @param array $items
     */
    protected function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return array
     */
    protected function optimizeUnwrap()
    {
        return $this->items;
    }
}