<?php

namespace Jabranr\PostcodesIO\Tests\Exception;

use Jabranr\PostcodesIO\Exception\MalformedJsonException;

class MalformedJsonExceptionTest extends \PHPUnit_Framework_TestCase {

    /**
     * @expectedException Jabranr\PostcodesIO\Exception\MalformedJsonException
     * @expectedExceptionCode 400
     * @expectedExceptionMessage Malformed json
     */
    public function testCorrectExceptionThrown() {
        throw new MalformedJsonException('Malformed json', 400);
    }
}
