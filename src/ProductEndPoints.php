<?php
namespace Axm\CopyLeaks;

use Axm\CopyLeaks\Exceptions\InvalidProductException;
use Cake\Utility\Hash;

/**
 * Class ProductEndPoints
 * @package Axm\CopyLeaks
 *
 * To create this do le copy-pasta and do a search for
 *      ^(POST|GET|DELETE) ([^\n ]+)\n([^\n]+)
 * and replace with
 * '$2' => [
 * 'type' => Constants::HTTP_$1,
 * 'uri' => '/$2',
 * 'description' => '$3'
 * ],
 */
class ProductEndPoints
{
    const BUSINESS_CALLS = [
        'create-by-url' => [
            'type' => Constants::HTTP_POST,
            'uri' => '/v1/businesses/create-by-url',
            'description' => 'Starting a new process by providing a URL to scan.'
        ],
        'create-by-file' => [
            'type' => Constants::HTTP_POST,
            'uri' => '/v2/businesses/create-by-file',
            'description' => 'Starting a new process by providing a file to scan.'
        ],
        'create-by-text' => [
            'type' => Constants::HTTP_POST,
            'uri' => '/v1/businesses/create-by-text',
            'description' => 'Starting a new process by providing a text to scan.'
        ],
        'create-by-file-ocr' => [
            'type' => Constants::HTTP_POST,
            'uri' => '/v1/businesses/create-by-file-ocr',
            'description' => 'Starting a new process by providing a photo with text.'
        ],
        'status' => [
            'type' => Constants::HTTP_GET,
            'uri' => '/v1/businesses/{ProcessId}/status',
            'description' => 'Get the scan progress details using the processId.'
        ],
        'result' => [
            'type' => Constants::HTTP_GET,
            'uri' => '/v1/businesses/{ProcessId}/result',
            'description' => 'Get the results using the processId.'
        ],
        '{ProcessId}/delete' => [
            'type' => Constants::HTTP_DELETE,
            'uri' => '/v1/businesses/{ProcessId}/delete',
            'description' => 'This Delete the specific process from the server, after getting the scan results. Only completed processes can be deleted.'
        ],
        'list' => [
            'type' => Constants::HTTP_GET,
            'uri' => '/v1/businesses/list',
            'description' => 'Receive a list of all your active processes.'
        ],
        'count-credits' => [
            'type' => Constants::HTTP_GET,
            'uri' => '/v1/businesses/count-credits',
            'description' => 'Get your credit balance.'
        ],
    ];

    /**
     * @param string $type
     * @param string $key
     * @return \stdClass
     * @throws InvalidProductException
     */
    public static function getCallDetails($type, $key)
    {
        $calls = self::getConstantValue($type);
        $details_array = Hash::get($calls, $key, []);
        return self::buildCallDetails($details_array);
    }

    /**
     * @param string $type
     * @return array
     * @throws InvalidProductException
     */
    protected static function getConstantValue($type)
    {
        $constant = strtoupper($type) . '_CALLS';
        $constant_name = 'self::' . $constant;
        if (!defined($constant_name)) {
            throw new InvalidProductException([$type]);
        }
        return constant($constant_name);
    }

    /**
     * @param array $details_array
     * @return \stdClass
     */
    protected static function buildCallDetails(array $details_array)
    {
        $details = new \stdClass();
        $details->type = Hash::get($details_array, 'type', 'get');
        $details->uri = Hash::get($details_array, 'uri', '');
        $details->description = Hash::get($details_array, 'description', 'Unknown detail');

        return $details;
    }

}