<?php

namespace Jabranr\PostcodesIO\Core;

use Jabranr\PostcodesIO\Interfaces\CurlRequestInterface;

/**
 * Make a HTTP request using CURL
 *
 * This class provides helper methods to make
 * HTTP requests using CURL
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @license  MIT license
 */
class CurlRequest implements CurlRequestInterface
{

  const CURL_USER_AGENT = 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)';

  /**
   * @var resource
   */
  private $handle;

  public function __construct($uri)
  {
    $this->handle = curl_init($uri);
    return $this;
  }

  public function setOption($name, $value)
  {
    curl_setopt($this->handle, $name, $value);
    return $this;
  }

  public function setOptions($options)
  {
    curl_setopt_array($this->handle, $options);
    return $this;
  }

  public function execute()
  {
    return curl_exec($this->handle);
  }

  public function getInfo($name = null)
  {
    if (!$name) {
      return curl_getinfo($this->handle);
    }

    return curl_getinfo($this->handle, $name);
  }

  public function getError()
  {
    return curl_error($this->handle);
  }

  public function getErrorCode()
  {
    return curl_errno($this->handle);
  }

  public function getStatusCode()
  {
    return $this->getInfo(CURLINFO_HTTP_CODE);
  }

  public function getRequestTime()
  {
    return $this->getInfo(CURLINFO_TOTAL_TIME);
  }

  public function close()
  {
    curl_close($this->handle);
    return $this;
  }
}
