<?php
namespace Axm\CopyLeaks\Entities;

use Axm\CopyLeaks\Response\Response;
use Rakshazi\GetSetTrait;

/**
 * Class Result
 * @package Axm\CopyLeaks\Entities
 *
 * @method int getId()
 * @method void setId(int $id)
 * @method string getUrl()
 * @method void setUrl(string $url)
 * @method int getPercentCopied()
 * @method void setPercentCopied(int $percent_copied)
 * @method int getNumCopiedWords()
 * @method void setNumCopiedWords(int $num_copied_words)
 * @method string getUrlComparisionReport()
 * @method void setUrlComparisionReport(string $url_comparision_report)
 * @method string getUrlCachedVersion()
 * @method void setUrlCachedVersion(string $url_cached_version)
 * @method string getTitle()
 * @method void setTitle(string $title)
 * @method string getIntroduction()
 * @method void setIntroduction(string $introduction)
 * @method string getUrlComparision()
 * @method void setUrlComparision(string $url_comparision)
 */
class Result
{
    use GetSetTrait;

    /**
     * @var int
     */
    protected $id;

    /**
     * The suspected URL
     * Available when the result originates online
     *
     * @var string
     */
    protected $url;

    /**
     * Percent of copied text from your content
     *
     * @var int
     */
    protected $percent_copied;

    /**
     * Number of copied words from your content
     *
     * @var int
     */
    protected $num_copied_words;

    /**
     * Link to a full comparison report
     *
     * @var string
     */
    protected $url_comparision_report;

    /**
     * The cached text of your scan
     *
     * @var string
     */
    protected $url_cached_version;

    /**
     * The specific result title
     *
     * @var string
     */
    protected $title;

    /**
     * The specific result introduction
     *
     * @var string
     */
    protected $introduction;

    /**
     * Embedded comparison report to include on your platform
     *
     * @var string
     */
    protected $url_comparision;

    /**
     * @param Response $response
     *
     * @return Result
     */
    public static function createFromResponse(Response $response)
    {
        $instance = new self();
        $id = self::getIdFromUrl($response->getBodyProperty('URL'));
        $instance->setId($id);
        $instance->setUrl($response->getBodyProperty('URL'));
        $instance->setPercentCopied($response->getBodyProperty('Percents'));
        $instance->setNumCopiedWords($response->getBodyProperty('NumberOfCopiedWords'));
        $instance->setUrlComparisionReport($response->getBodyProperty('ComparisonReport'));
        $instance->setUrlCachedVersion($response->getBodyProperty('CachedVersion'));
        $instance->setTitle($response->getBodyProperty('Title'));
        $instance->setIntroduction($response->getBodyProperty('Introduction'));
        $instance->setUrlComparision($response->getBodyProperty('EmbededComparison'));

        return $instance;
    }

    /**
     * @param string $url
     * @return int
     */
    protected static function getIdFromUrl($url)
    {
        $split = explode('=', $url);

        return (int)end($split);
    }
}
