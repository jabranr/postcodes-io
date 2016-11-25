<?php

namespace Jabranr\PostcodesIO\Tests\Exception;

use Jabranr\PostcodesIO\Exception\BadResponseException;

class BadResponseExceptionTest extends \PHPUnit_Framework_TestCase {

    /**
     * @expectedException Jabranr\PostcodesIO\Exception\BadResponseException
     * @expectedExceptionCode 400
     * @expectedExceptionMessage Bad Response
     */
    public function testCorrectExceptionThrown() {
        throw new BadResponseException('Bad Response', 400);
    }
}
