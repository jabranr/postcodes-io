<?php

namespace Jabranr\PostcodesIO\Tests;

use PHPUnit\Framework\TestCase;
use Jabranr\PostcodesIO\PostcodesIO;

class PostcodesIOTest extends TestCase
{

  public $postcodeIO;
  public $latitude;
  public $longitude;
  public $validPostcode;
  public $inValidPostcode;
  public $searchText;

  public function setUp(): void
  {
    $this->postcodeIO = new PostcodesIO();
    $this->latitude = 51.520331;
    $this->longitude = -0.1396267;
    $this->validPostcode = 'W1T 7NY';
    $this->inValidPostcode = 'TW16 7WT';
    $this->searchText = 'Willoughby Hedge';
  }

  public function tearUp()
  {
    $this->postcodeIO = null;
    $this->latitude = null;
    $this->longitude = null;
    $this->validPostcode = null;
    $this->inValidPostcode = null;
  }

  public function testVersion()
  {
    $composerJson = file_get_contents(__DIR__ . '/../composer.json');
    $composerJson = json_decode($composerJson);
    $this->assertEquals($composerJson->version, PostcodesIO::VERSION);
  }

  public function testFindLocation()
  {
    $address = $this->postcodeIO->findByLocation($this->latitude, $this->longitude);

    $this->assertInstanceOf('stdClass', $address);
    $this->assertObjectHasAttribute('status', $address);
    $this->assertObjectHasAttribute('result', $address);

    $this->assertEquals(200, $address->status);
    $this->assertEquals('array', gettype($address->result));
    $this->assertGreaterThanOrEqual(1, count($address->result));
    $this->assertObjectHasAttribute('postcode', $address->result[0]);
    $this->assertObjectHasAttribute('latitude', $address->result[0]);
    $this->assertObjectHasAttribute('longitude', $address->result[0]);
  }

  public function testFindRandom()
  {
    $address = $this->postcodeIO->findRandom();

    $this->assertInstanceOf('stdClass', $address);
    $this->assertObjectHasAttribute('status', $address);
    $this->assertObjectHasAttribute('result', $address);

    $this->assertEquals(200, $address->status);
    $this->assertInstanceOf('stdClass', $address->result);
    $this->assertObjectHasAttribute('postcode', $address->result);
    $this->assertObjectHasAttribute('latitude', $address->result);
    $this->assertObjectHasAttribute('longitude', $address->result);
  }

  public function testValidateWithValidPostcodeSuccess()
  {
    $address = $this->postcodeIO->validate($this->validPostcode);

    $this->assertInstanceOf('stdClass', $address);
    $this->assertObjectHasAttribute('status', $address);
    $this->assertObjectHasAttribute('result', $address);

    $this->assertEquals(200, $address->status);
    $this->assertTrue($address->result);
  }

  public function testValidateWithInvalidPostcodeFailure()
  {
    $address = $this->postcodeIO->validate($this->inValidPostcode);

    $this->assertInstanceOf('stdClass', $address);
    $this->assertObjectHasAttribute('status', $address);
    $this->assertObjectHasAttribute('result', $address);

    $this->assertEquals(200, $address->status);
    $this->assertFalse($address->result);
  }

  public function testValidateWithSearchTextSuccess()
  {
    $address = $this->postcodeIO->validate($this->searchText);

    $this->assertInstanceOf('stdClass', $address);
    $this->assertObjectHasAttribute('status', $address);
    $this->assertObjectHasAttribute('result', $address);

    $this->assertEquals(200, $address->status);
    $this->assertFalse($address->result);
  }

  public function testFindNearest()
  {
    $address = $this->postcodeIO->findNearest($this->validPostcode);

    $this->assertInstanceOf('stdClass', $address);
    $this->assertObjectHasAttribute('status', $address);
    $this->assertObjectHasAttribute('result', $address);

    $this->assertEquals(200, $address->status);
    $this->assertEquals('array', gettype($address->result));
    $this->assertGreaterThanOrEqual(1, count($address->result));
    $this->assertObjectHasAttribute('postcode', $address->result[0]);
    $this->assertObjectHasAttribute('latitude', $address->result[0]);
    $this->assertObjectHasAttribute('longitude', $address->result[0]);
  }

  public function testAutocompleteSuccess()
  {
    $address = $this->postcodeIO->autocomplete($this->validPostcode);

    $this->assertInstanceOf('stdClass', $address);
    $this->assertObjectHasAttribute('status', $address);
    $this->assertObjectHasAttribute('result', $address);

    $this->assertEquals(200, $address->status);
    $this->assertEquals('array', gettype($address->result));
    $this->assertGreaterThanOrEqual(1, count($address->result));
  }

  public function testAutocompleteFailure()
  {
    $address = $this->postcodeIO->autocomplete($this->inValidPostcode);

    $this->assertInstanceOf('stdClass', $address);
    $this->assertObjectHasAttribute('status', $address);
    $this->assertObjectHasAttribute('result', $address);

    $this->assertEquals(200, $address->status);
    $this->assertNull($address->result);
  }

  public function testQueryPostcodeSuccess()
  {
    $address = $this->postcodeIO->query($this->validPostcode);

    $this->assertInstanceOf('stdClass', $address);
    $this->assertObjectHasAttribute('status', $address);
    $this->assertObjectHasAttribute('result', $address);

    $this->assertEquals(200, $address->status);
    $this->assertEquals('array', gettype($address->result));
    $this->assertGreaterThanOrEqual(1, count($address->result));
  }

  public function testQueryPostcodeFailure()
  {
    $address = $this->postcodeIO->query($this->inValidPostcode);

    $this->assertInstanceOf('stdClass', $address);
    $this->assertObjectHasAttribute('status', $address);
    $this->assertObjectHasAttribute('result', $address);

    $this->assertEquals(200, $address->status);
    $this->assertNull($address->result);
  }

  public function testFindOutcodeSuccess()
  {
    $outcode = explode(' ', $this->validPostcode)[0];
    $address = $this->postcodeIO->findOutcode($outcode);

    $this->assertInstanceOf('stdClass', $address);
    $this->assertObjectHasAttribute('status', $address);
    $this->assertObjectHasAttribute('result', $address);

    $this->assertEquals(200, $address->status);
    $this->assertInstanceOf('stdClass', $address->result);
    $this->assertObjectHasAttribute('latitude', $address->result);
    $this->assertObjectHasAttribute('longitude', $address->result);
  }

  public function testFindNearestOutcode()
  {
    $outcode = explode(' ', $this->validPostcode)[0];
    $address = $this->postcodeIO->nearestOutcode($outcode);

    $this->assertInstanceOf('stdClass', $address);
    $this->assertObjectHasAttribute('status', $address);
    $this->assertObjectHasAttribute('result', $address);

    $this->assertEquals(200, $address->status);
    $this->assertEquals('array', gettype($address->result));
    $this->assertGreaterThanOrEqual(1, count($address->result));
    $this->assertObjectHasAttribute('latitude', $address->result[0]);
    $this->assertObjectHasAttribute('longitude', $address->result[0]);
  }

  public function testFindOutcodeByLocation()
  {
    $address = $this->postcodeIO->findOutcodeByLocation($this->latitude, $this->longitude);

    $this->assertInstanceOf('stdClass', $address);
    $this->assertObjectHasAttribute('status', $address);
    $this->assertObjectHasAttribute('result', $address);

    $this->assertEquals(200, $address->status);
    $this->assertEquals('array', gettype($address->result));
    $this->assertGreaterThanOrEqual(1, count($address->result));
    $this->assertObjectHasAttribute('latitude', $address->result[0]);
    $this->assertObjectHasAttribute('longitude', $address->result[0]);
  }

  public function testBulkPostcodeSearch()
  {
    $address = $this->postcodeIO->bulkPostcodeSearch(array(
      $this->validPostcode,
      $this->inValidPostcode
    ));

    $this->assertInstanceOf('stdClass', $address);
    $this->assertObjectHasAttribute('status', $address);
    $this->assertObjectHasAttribute('result', $address);

    $this->assertEquals(200, $address->status);
    $this->assertEquals('array', gettype($address->result));
    $this->assertGreaterThanOrEqual(1, count($address->result));
    $this->assertObjectHasAttribute('query', $address->result[0]);
  }

  public function testBulkReverseGeocoding()
  {
    $address = $this->postcodeIO->bulkReverseGeocoding(array(
      array(
        $this->latitude,
        $this->longitude
      ),
      array(
        $this->latitude,
        $this->longitude
      )
    ));

    $this->assertInstanceOf('stdClass', $address);
    $this->assertObjectHasAttribute('status', $address);
    $this->assertObjectHasAttribute('result', $address);

    $this->assertEquals(200, $address->status);
    $this->assertEquals('array', gettype($address->result));
    $this->assertGreaterThanOrEqual(1, count($address->result));
    $this->assertObjectHasAttribute('query', $address->result[0]);
  }

  public function testBulkReverseGeocodingWithAssociatedArrayData()
  {
    $address = $this->postcodeIO->bulkReverseGeocoding(array(
      array(
        'latitude' => $this->latitude,
        'longitude' => $this->longitude
      ),
      array(
        'latitude' => $this->latitude,
        'longitude' => $this->longitude
      )
    ));

    $this->assertInstanceOf('stdClass', $address);
    $this->assertObjectHasAttribute('status', $address);
    $this->assertObjectHasAttribute('result', $address);

    $this->assertEquals(200, $address->status);
    $this->assertEquals('array', gettype($address->result));
    $this->assertGreaterThanOrEqual(1, count($address->result));
    $this->assertObjectHasAttribute('query', $address->result[0]);
  }
}
