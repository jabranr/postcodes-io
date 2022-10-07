<?php

namespace Jabranr\PostcodesIO\Tests\Exception;

use Jabranr\PostcodesIO\Exception\BadRequestException;

class BadRequestExceptionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException Jabranr\PostcodesIO\Exception\BadRequestException
     * @expectedExceptionCode 400
     * @expectedExceptionMessage Bad Request
     */
    public function testCorrectExceptionThrown()
    {
        throw new BadRequestException('Bad Request', 400);
    }
}
