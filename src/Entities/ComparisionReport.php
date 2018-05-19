<?php
namespace Axm\CopyLeaks\Entities;

use Axm\CopyLeaks\Collections\TextComparisonsCollection;
use Axm\CopyLeaks\Response\Response;
use Rakshazi\GetSetTrait;

/**
 * Class ComparisionReport
 * @package Axm\CopyLeaks\Entities
 *
 * @method TextComparisonsCollection getIdentical()
 * @method void setIdentical(TextComparisonsCollection $identical)
 * @method TextComparisonsCollection getSimilar()
 * @method void setSimilar(TextComparisonsCollection $similar)
 * @method TextComparisonsCollection getRelated()
 * @method void setRelated(TextComparisonsCollection $related)
 * @method int getIdenticalWords()
 * @method void setIdenticalWords(int $identical_words)
 * @method int getSimilarWords()
 * @method void setSimilarWords(int $similar_words)
 * @method int getRelatedWords()
 * @method void setRelatedWords(int $related_words)
 * @method int getTotalCopiedWords()
 * @method void setTotalCopiedWords(int $total_copied_words)
 * @method int getTotalWords()
 * @method void setTotalWords(int $total_words)
 */
class ComparisionReport
{
    use GetSetTrait;

    /**
     * @var TextComparisonsCollection
     */
    protected $identical;

    /**
     * @var TextComparisonsCollection
     */
    protected $similar;

    /**
     * @var TextComparisonsCollection
     */
    protected $related;

    /**
     * @var int
     */
    protected $identical_words = 7;

    /**
     * @var int
     */
    protected $similar_words = 2;

    /**
     * @var int
     */
    protected $related_words = 3;

    /**
     * @var int
     */
    protected $total_copied_words = 17;

    /**
     * @var int
     */
    protected $total_words = 148;

    /**
     * @param Response $response
     *
     * @return ComparisionReport
     */
    public static function createFromResponse(Response $response)
    {
        $instance = new self();
        $instance->setIdentical(self::buildTextComparisionCollection(
            $response,
            'Identical'
        ));
        $instance->setSimilar(self::buildTextComparisionCollection(
            $response,
            'Similar'
        ));
        $instance->setRelated(self::buildTextComparisionCollection(
            $response,
            'RelatedMeaning'
        ));
        $instance->setIdenticalWords($response->getBodyProperty('IdenticalCopiedWords'));
        $instance->setSimilarWords($response->getBodyProperty('SimilarCopiedWords'));
        $instance->setRelatedWords($response->getBodyProperty('RelatedMeaningCopiedWords'));
        $instance->setTotalCopiedWords($response->getBodyProperty('TotalCopiedWords'));
        $instance->setTotalWords($response->getBodyProperty('TotalWords'));

        return $instance;
    }

    /**
     * @param Response $response
     * @param string $type
     * @return TextComparisonsCollection
     */
    protected static function buildTextComparisionCollection(Response $response, $type)
    {
        $data = $response->getBodyProperty($type);

        return TextComparisonsCollection::createFromArray($data, $type);
    }
}