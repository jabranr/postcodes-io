<?php

namespace Jabranr\PostcodesIO;

use Jabranr\PostcodesIO\Core\BasePostcodesIO;
use Jabranr\PostcodesIO\Exception\MaximumLimitExceededException;

/**
 * Library for postcodes.io API
 *
 * This class provides helper methods to use
 * postcodes.io API to find postcodes information.
 *
 * @author Jabran Rafique <hello@jabran.me>
 * @license  MIT license
 */

class PostcodesIO extends BasePostcodesIO
{

  /**
   * Look up postcodes by geolocation
   *
   * @param float $latitude
   * @param float $longitude
   * @return stdClass
   */
  public function findByLocation($latitude, $longitude)
  {
    return $this->get(BasePostcodesIO::API_POSTCODES_ENDPOINT, array(
      'lat' => (float) $latitude,
      'lon' => (float) $longitude
    ));
  }

  /**
   * Get a list of results from random postcodes
   *
   * @return stdClass
   */
  public function findRandom()
  {
    return $this->get(
      sprintf('/random%s', BasePostcodesIO::API_POSTCODES_ENDPOINT)
    );
  }

  /**
   * An alias of findRandom method
   *
   * @return stdClass
   */
  public function random()
  {
    return $this->findRandom();
  }

  /**
   * Validate a postcode
   *
   * @param string $postcode
   * @return stdClass
   */
  public function validate($postcode)
  {
    return $this->get(
      sprintf('/%s/%s/validate', BasePostcodesIO::API_POSTCODES_ENDPOINT, rawurlencode($postcode))
    );
  }

  /**
   * Find list of nearest addresses
   *
   * @param string $postcode
   * @return stdClass
   */
  public function findNearest($postcode)
  {
    return $this->get(
      sprintf('/%s/%s/nearest', BasePostcodesIO::API_POSTCODES_ENDPOINT, rawurlencode($postcode))
    );
  }

  /**
   * An alias of findNearest method
   *
   * @param string $postcode
   * @return stdClass
   */
  public function nearest($postcode)
  {
    return $this->findNearest($postcode);
  }

  /**
   * Get list of autocompleted postcodes
   *
   * @param string $postcode
   * @return stdClass
   */
  public function autocomplete($postcode)
  {
    return $this->get(
      sprintf('/%s/%s/autocomplete', BasePostcodesIO::API_POSTCODES_ENDPOINT, rawurlencode($postcode))
    );
  }

  /**
   * Query a postcode
   *
   * @param string $postcode
   * @return stdClass
   */
  public function query($postcode)
  {
    return $this->get(BasePostcodesIO::API_POSTCODES_ENDPOINT, array(
      'q' => $postcode
    ));
  }

  /**
   * Search a postcode
   * An alias of query method
   *
   * @param string $postcode
   * @return stdClass
   */
  public function search($postcode)
  {
    return $this->query($postcode);
  }

  /**
   * Find outcode information
   *
   * @param string $outcode
   * @param stdClass
   */
  public function findOutcode($outcode)
  {
    return $this->get(
      sprintf('%s/%s', BasePostcodesIO::API_OUTCODES_ENDPOINT, $outcode)
    );
  }

  /**
   * Find near outcode
   *
   * @param string $outcode
   * @param stdClass
   */
  public function nearestOutcode($outcode)
  {
    return $this->get(
      sprintf('%s/%s/nearest', BasePostcodesIO::API_OUTCODES_ENDPOINT, $outcode)
    );
  }

  /**
   * Find outcode by geolocation
   *
   * @param float $latitude
   * @param float $longitude
   * @param stdClass
   */
  public function findOutcodeByLocation($latitude, $longitude)
  {
    return $this->get(BasePostcodesIO::API_OUTCODES_ENDPOINT, array(
      'lat' => (float) $latitude,
      'lon' => (float) $longitude
    ));
  }

  /**
   * Search postcodes in bulk (up to 100 maximum in one request)
   *
   * @param array $postcodes
   * @return stdClass
   */
  public function bulkPostcodeSearch(array $postcodes)
  {
    if (null !== $postcodes && count($postcodes) > BasePostcodesIO::BULK_SEARCH_LIMIT) {
      throw new MaximumLimitExceededException(
        sprintf('You can only search a maximum of %d postcodes in one request.', BasePostcodesIO::BULK_SEARCH_LIMIT)
      );
    }

    return $this->post(BasePostcodesIO::API_POSTCODES_ENDPOINT, array(
      'postcodes' => $postcodes
    ));
  }

  /**
   * Make reverse geocoding search in bulk (up to 100 maximum in one request)
   *
   * @param array $geolocations
   * @return stdClass
   */
  public function bulkReverseGeocoding(array $geolocations)
  {
    if (null !== $geolocations && count($geolocations) > BasePostcodesIO::BULK_SEARCH_LIMIT) {
      throw new MaximumLimitExceededException(
        sprintf('You can only search a maximum of %d geolocations in one request.', BasePostcodesIO::BULK_SEARCH_LIMIT)
      );
    }

    $updatedGeolocations = [];
    foreach ($geolocations as $geolocation) {
      $location = [];

      if (!array_key_exists('latitude', $geolocation)) {
        $location['latitude'] = $geolocation[0];
      }

      if (!array_key_exists('longitude', $geolocation)) {
        $location['longitude'] = $geolocation[1];
      }

      if (count($location) > 0) {
        $updatedGeolocations[] = $location;
      }
    }

    return $this->post(BasePostcodesIO::API_POSTCODES_ENDPOINT, array(
      'geolocations' => count($updatedGeolocations) > 0 ? $updatedGeolocations : $geolocations
    ));
  }
}
