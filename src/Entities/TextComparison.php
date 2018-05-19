<?php
namespace Axm\CopyLeaks\Entities;

use Axm\CopyLeaks\Response\Response;
use Rakshazi\GetSetTrait;

/**
 * Class TextComparison
 * @package Axm\CopyLeaks\Entities
 *
 * @method int getWordCount()
 * @method void setWordCount(int $word_count)
 * @method int getSourceStart()
 * @method void setSourceStart(int $source_start)
 * @method int getSourceWordStart()
 * @method void setSourceWordStart(int $source_word_start)
 * @method int getSourceWordEnd()
 * @method void setSourceWordEnd(int $source_word_end)
 * @method int getSourceEnd()
 * @method void setSourceEnd(int $source_end)
 * @method int getSuspectedStart()
 * @method void setSuspectedStart(int $suspected_start)
 * @method int getSuspectedEnd()
 * @method void setSuspectedEnd(int $suspected_end)
 * @method int getSuspectedWordStart()
 * @method void setSuspectedWordStart(int $suspected_word_start)
 * @method int getSuspectedWordEnd()
 * @method void setSuspectedWordEnd(int $suspected_word_end)
 */
class TextComparison
{
    use GetSetTrait;

    /**
     * Word Count (WC)
     *
     * amount of copied words in this specific copied string.
     *
     * @var int
     */
    protected $word_count;

    /**
     * Source Start (Sos)
     *
     * the start position of the specific copied string in your source (your submitted content).
     *
     * @var int
     */
    protected $source_start;

    /**
     * Source Word Start (SoWS)
     *
     * the place of the starting word in your source (i.e. 99 means 98 words come before).
     *
     * @var int
     */
    protected $source_word_start;

    /**
     * Source Word End (SoWE)
     *
     * the place of the ending word in your source (i.e. 99 means 98 words come before).
     *
     * @var int
     */
    protected $source_word_end;

    /**
     * Source End (SoE)
     *
     * the end position of the specific copied string in your source (your submitted content).
     *
     * @var int
     */
    protected $source_end;

    /**
     * Suspected Start (SuS)
     *
     * the start position of the specific copied string in the suspected page (the result that was found).
     *
     * @var int
     */
    protected $suspected_start;

    /**
     * Suspected End (SuE)
     *
     * the end position of the specific copied string in the suspected page (the result that was found).
     *
     * @var int
     */
    protected $suspected_end;

    /**
     * Suspected Word Start (SuWS)
     *
     * the place of the starting word in the suspected content (i.e. 99 means 98 words come before).
     *
     * @var int
     */
    protected $suspected_word_start;

    /**
     * Suspected Word End (SuWE)
     *
     * the place of the ending word in the suspected content (i.e. 99 means 98 words come before).
     *
     * @var int
     */
    protected $suspected_word_end;

    public static function createFromResponse(Response $response)
    {
        $instance = new self();
        $instance->setWordCount($response->getBodyProperty('WC'));
        $instance->setSourceStart($response->getBodyProperty('SoS'));
        $instance->setSourceEnd($response->getBodyProperty('SoE'));
        $instance->setSourceWordStart($response->getBodyProperty('SoWS'));
        $instance->setSourceWordEnd($response->getBodyProperty('SoWE'));
        $instance->setSuspectedStart($response->getBodyProperty('SuS'));
        $instance->setSuspectedEnd($response->getBodyProperty('SuE'));
        $instance->setSuspectedWordStart($response->getBodyProperty('SuWS'));
        $instance->setSuspectedWordEnd($response->getBodyProperty('SuWE'));

        return $instance;
    }
}
