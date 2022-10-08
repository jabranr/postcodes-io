<?php

namespace Jabranr\PostcodesIO\Tests\Exception;

use PHPUnit\Framework\TestCase;
use Jabranr\PostcodesIO\Exception\PostcodeIOException;

class PostcodeIOExceptionTest extends TestCase
{
  public function testCorrectExceptionThrown()
  {
    $this->assertInstanceOf(PostcodeIOException::class, new PostcodeIOException);
    $this->expectException(PostcodeIOException::class);
    $this->expectExceptionCode(400);
    $this->expectExceptionMessage('Base exception thrown');
    throw new PostcodeIOException('Base exception thrown', 400);
  }
}
