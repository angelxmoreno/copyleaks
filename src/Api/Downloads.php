<?php
namespace Axm\CopyLeaks\Api;

use Axm\CopyLeaks\Constants;
use Axm\CopyLeaks\Response\Response;

/**
 * Trait Downloads
 * @package Axm\CopyLeaks\Api
 *
 * @method Response buildRequest(string $type, string $uri, array $params = [], array $headers = [])
 * @method Response buildAuthenticatedRequest(string $type, string $uri, array $params = [], array $headers = [])
 */
trait Downloads
{
    /**
     * @param string $process_id
     * @return string
     */
    public function sourceText($process_id)
    {
        $response = $this->buildAuthenticatedRequest(
            Constants::HTTP_GET,
            Constants::URI_SOURCE_TEXT,
            [
                'pid' => $process_id
            ]
        );

        return $response->getBodyProperty(0);
    }

    /**
     * @param string $result_id
     * @return string
     */
    public function resultText($result_id)
    {
        $response = $this->buildAuthenticatedRequest(
            Constants::HTTP_GET,
            Constants::URI_RESULT_TEXT,
            [
                'rid' => $result_id
            ]
        );

        return $response->getBodyProperty(0);
    }

    /**
     * @param string $result_id
     * @return string
     */
    public function comparisonReport($result_id)
    {
        $response = $this->buildAuthenticatedRequest(
            Constants::HTTP_GET,
            Constants::URI_COMPARISON,
            [
                'rid' => $result_id
            ]
        );

        return $response->getBody();
    }


}
