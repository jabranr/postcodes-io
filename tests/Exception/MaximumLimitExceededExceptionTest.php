<?php

namespace Jabranr\PostcodesIO\Tests\Exception;

use PHPUnit\Framework\TestCase;
use Jabranr\PostcodesIO\Exception\MaximumLimitExceededException;

class MaximumLimitExceededExceptionTest extends TestCase
{
  public function testCorrectExceptionThrown()
  {
    $this->assertInstanceOf(MaximumLimitExceededException::class, new MaximumLimitExceededException);
    $this->expectException(MaximumLimitExceededException::class);
    $this->expectExceptionCode(400);
    $this->expectExceptionMessage('Maximum limit exceeded');
    throw new MaximumLimitExceededException('Maximum limit exceeded', 400);
  }
}
