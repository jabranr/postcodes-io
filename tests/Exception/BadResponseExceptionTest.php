<?php

namespace Jabranr\PostcodesIO\Tests\Exception;

use PHPUnit\Framework\TestCase;
use Jabranr\PostcodesIO\Exception\BadResponseException;

class BadResponseExceptionTest extends TestCase
{


  public function testCorrectExceptionThrown()
  {
    $this->assertInstanceOf(BadResponseException::class, new BadResponseException);
    $this->expectException(BadResponseException::class);
    $this->expectExceptionCode(400);
    $this->expectExceptionMessage('Bad Response');
    throw new BadResponseException('Bad Response', 400);
  }
}
