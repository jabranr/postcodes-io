<?php

namespace Jabranr\PostcodesIO\Tests\Exception;

use Jabranr\PostcodesIO\Exception\PostcodeIOException;

class PostcodeIOExceptionTest extends \PHPUnit_Framework_TestCase {

    /**
     * @expectedException Jabranr\PostcodesIO\Exception\PostcodeIOException
     * @expectedExceptionCode 400
     * @expectedExceptionMessage Base exception thrown
     */
    public function testCorrectExceptionThrown() {
        throw new PostcodeIOException('Base exception thrown', 400);
    }
}
