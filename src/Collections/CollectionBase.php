<?php
namespace Axm\CopyLeaks\Collections;

use Cake\Collection\CollectionTrait;
use Rakshazi\GetSetTrait;

/**
 * Class CollectionBase
 * @package Axm\CopyLeaks\Collections
 */
abstract class CollectionBase
{
    use CollectionTrait;
    use GetSetTrait;
    
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