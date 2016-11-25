<?php

namespace Jabranr\PostcodesIO\Tests\Core;

use Jabranr\PostcodesIO\PostcodesIO;

class BasePostcodesIOTest extends \PHPUnit_Framework_TestCase {

    public $postcodeFinder;
    public $validPostcode;

    public function setUp() {
        $this->postcodeFinder = new PostcodesIO();
        $this->validPostcode = 'W1T 7NY';
    }

    public function tearUp() {
        $this->postcodeFinder = null;
        $this->validPostcode = null;
    }

    public function testConstants() {
        $this->assertEquals('https://api.postcodes.io', PostcodesIO::API_URI);
        $this->assertEquals('/postcodes', PostcodesIO::API_POSTCODES_ENDPOINT);
    }

    public function testBareConstructor() {
        $this->assertInstanceOf('Jabranr\PostcodesIO\PostcodesIO', $this->postcodeFinder);
        $this->assertObjectHasAttribute('result', $this->postcodeFinder);
        $this->assertNull($this->postcodeFinder->result);
    }

    public function testConstructor() {
        $postcodeFinder = new PostcodesIO($this->validPostcode);
        $this->assertInstanceOf('Jabranr\PostcodesIO\PostcodesIO', $postcodeFinder);
        $this->assertObjectHasAttribute('result', $postcodeFinder);
        $this->assertNotNull($postcodeFinder->result);
    }

    public function testFind() {
        $address = $this->postcodeFinder->find($this->validPostcode);

        $this->assertInstanceOf('stdClass', $address);
        $this->assertObjectHasAttribute('result', $address);

        $this->assertInstanceOf('stdClass', $address->result);
        $this->assertObjectHasAttribute('postcode', $address->result);
        $this->assertEquals($this->validPostcode, $address->result->postcode);

        $this->assertObjectHasAttribute('incode', $address->result);
        $this->assertObjectHasAttribute('outcode', $address->result);

        list($outcode, $incode) = explode(' ', $this->validPostcode);

        $this->assertEquals($outcode, $address->result->outcode);
        $this->assertEquals($incode, $address->result->incode);
    }

    public function testTrimClean() {
        $string = '/foo/bar/';
        $cleanedString = $this->postcodeFinder->trimClean($string);
        $this->assertEquals('foo/bar/', $cleanedString);
    }

    public function testGetApiUri() {
        $expectedUri = sprintf('%s/%s', PostcodesIO::API_URI, $this->postcodeFinder->trimClean(PostcodesIO::API_POSTCODES_ENDPOINT));

        $this->assertEquals($expectedUri, $this->postcodeFinder->getApiUri('/postcodes'));
    }

    public function testGetApiUriWithQueryString() {
        $expectedUri = sprintf('%s/%s?foo=bar', PostcodesIO::API_URI, $this->postcodeFinder->trimClean(PostcodesIO::API_POSTCODES_ENDPOINT));

        $this->assertEquals($expectedUri, $this->postcodeFinder->getApiUri('/postcodes', array('foo' => 'bar')));
    }
}
