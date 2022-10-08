<?php

namespace Jabranr\PostcodesIO\Tests\Exception;

use PHPUnit\Framework\TestCase;
use Jabranr\PostcodesIO\Exception\BadRequestException;

class BadRequestExceptionTest extends TestCase
{

  public function testCorrectExceptionThrown()
  {
    $this->assertInstanceOf(BadRequestException::class, new BadRequestException);
    $this->expectException(BadRequestException::class);
    $this->expectExceptionCode(400);
    $this->expectExceptionMessage('Bad Request');
    throw new BadRequestException('Bad Request', 400);
  }
}
