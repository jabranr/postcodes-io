<?php

namespace Jabranr\PostcodesIO\Interfaces;

interface CurlRequestInterface
{

  /**
   * Set options for cURL request
   */
  public function setOption($name, $value);

  /**
   * Execute a cURL request
   */
  public function execute();

  /**
   * Get cURL request info
   */
  public function getInfo($name);

  /**
   * Get cURL status code
   */
  public function getStatusCode();

  /**
   * Get cURL error
   */
  public function getError();

  /**
   * Get cURL error code
   *
   * @see https://curl.haxx.se/libcurl/c/libcurl-errors.html
   */
  public function getErrorCode();

  /**
   * Get cURL request time
   */
  public function getRequestTime();

  /**
   * Close a cURL connection
   */
  public function close();
}
