<?php

namespace Jabranr\PostcodesIO\Tests\Exception;

use Jabranr\PostcodesIO\Exception\MaximumLimitExceededException;

class MaximumLimitExceededExceptionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException Jabranr\PostcodesIO\Exception\MaximumLimitExceededException
     * @expectedExceptionCode 400
     * @expectedExceptionMessage Maximum limit exceeded
     */
    public function testCorrectExceptionThrown()
    {
        throw new MaximumLimitExceededException('Maximum limit exceeded', 400);
    }
}
