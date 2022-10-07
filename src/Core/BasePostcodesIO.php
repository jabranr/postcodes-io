<?php

namespace Jabranr\PostcodesIO\Core;

use Jabranr\PostcodesIO\Exception\BadRequestException;
use Jabranr\PostcodesIO\Exception\BadResponseException;
use Jabranr\PostcodesIO\Exception\MalformedJsonException;
use Jabranr\PostcodesIO\Interfaces\PostcodesIOInterface;

/**
 * Postcode finder abstract base class
 *
 * This class provides core methods to find
 * postcodes data from postcodes.io API
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @license  MIT license
 */
abstract class BasePostcodesIO implements PostcodesIOInterface
{

    const API_URI = 'https://api.postcodes.io';
    const API_POSTCODES_ENDPOINT = '/postcodes';
    const API_OUTCODES_ENDPOINT = '/outcodes';
    const BULK_SEARCH_LIMIT = 100;
    const VERSION = '1.1.0';

    /**
     * @var mixed
     */
    private $result;

    /**
     * @param string $postcode
     * @return Jabranr\PostcodesIO\BasePostcodesIO
     */
    public function __construct($postcode = null)
    {
        if (!empty($postcode)) {
            $response = $this->find($postcode);
            $this->result = $response;
        }

        return $this;
    }

    /**
     * Look up a postcode
     *
     * @param string $postcode
     * @return mixed
     */
    public function find($postcode)
    {
        if ($postcode && gettype($postcode) !== 'string') {
            throw new \InvalidArgumentException('Postcode can only be in string format.', 400);
        }

        return $this->get(
            sprintf('%s/%s', BasePostcodesIO::API_POSTCODES_ENDPOINT, $postcode)
        );
    }

    /**
     * Make a HTTP GET call
     *
     * @codeCoverageIgnore
     *
     * @param string $endpoint
     * @param array $query
     * @throws Jabranr\PostcodesIO\Exception\BadResponseException
     * @throws Jabranr\PostcodesIO\Exception\MalformedJsonException
     * @return stdClass
     */
    protected function get($endpoint, array $query = null)
    {
        $uri = $this->getApiUri($endpoint, $query);
        $response = file_get_contents($uri);

        if (!$response) {
            throw new BadResponseException('Unable to make a successful request.');
        }

        $response = json_decode($response);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new MalformedJsonException(json_last_error_msg(), 400);
        }

        $this->result = $response;
        return $response;
    }

    /**
     * Make a HTTP POST request
     *
     * @codeCoverageIgnore
     *
     * @param string $endpoint
     * @param array $data
     * @throws Jabranr\PostcodesIO\Exception\BadRequestException
     * @throws Jabranr\PostcodesIO\Exception\MalformedJsonException
     * @return mixed
     */
    protected function post($endpoint, array $data)
    {
        $uri = $this->getApiUri($endpoint);
        $data = json_encode($data);

        $curl = new CurlRequest($uri);
        $curl->setOptions(array(
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                sprintf('Content-Length: %d', strlen($data))
            )
        ));

        $response = $curl->execute();
        $errorCode = $curl->getErrorCode();
        $statusCode = $curl->getStatusCode();
        $curl->close();

        if ($errorCode !== CURLE_OK) {
            throw new BadRequestException(
                sprintf('StatusCode (%d): Couldn\'t complete the request.', $statusCode)
            );
        }

        $response = json_decode($response);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new MalformedJsonException(json_last_error_msg(), 400);
        }

        $this->result = $response;
        return $response;
    }

    /**
     * Build a structured API URI
     *
     * @param string $endpoint
     * @param array $query
     * @return string
     */
    public function getApiUri($endpoint, array $query = null)
    {
        $uri = sprintf('%s/%s', BasePostcodesIO::API_URI, $this->trimClean($endpoint));

        if ($query && is_array($query)) {
            $uri = sprintf('%s?%s', $uri, http_build_query($query));
        }

        return $uri;
    }

    /**
     * Clean string from leading slash
     *
     * @param string $str
     * @return string
     */
    public function trimClean($str)
    {
        return ltrim($str, '/');
    }

    /**
     * @codeCoverageIgnore
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @codeCoverageIgnore
     */
    public function setResult($result)
    {
        $this->result = $result;
        return $this;
    }
}
