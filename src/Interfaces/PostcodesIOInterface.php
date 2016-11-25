<?php

namespace Jabranr\PostcodesIO\Interfaces;

interface PostcodesIOInterface {

    /**
     * Find a postcode
     */
    public function find($postcode);

    /**
     * Make a get request
     */
    public function get($endpoint, array $query);

    /**
     * Make a post request
     */
    public function post($endpoint, array $data);
}
