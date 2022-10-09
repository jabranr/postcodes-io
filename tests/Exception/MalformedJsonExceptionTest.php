<?php

namespace Jabranr\PostcodesIO\Tests\Exception;

use PHPUnit\Framework\TestCase;
use Jabranr\PostcodesIO\Exception\MalformedJsonException;

class MalformedJsonExceptionTest extends TestCase
{
  public function testCorrectExceptionThrown()
  {
    $this->assertInstanceOf(MalformedJsonException::class, new MalformedJsonException);
    $this->expectException(MalformedJsonException::class);
    $this->expectExceptionCode(400);
    $this->expectExceptionMessage('Malformed json');
    throw new MalformedJsonException('Malformed json', 400);
  }
}
