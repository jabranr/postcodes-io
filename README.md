# PostcodesIO [![Tests](https://github.com/jabranr/postcodes-io/actions/workflows/phpunit-tests.yml/badge.svg)](https://github.com/jabranr/postcodes-io/actions/workflows/phpunit-tests.yml) ![Packagist Version](https://img.shields.io/packagist/v/jabranr/postcodes-io?style=flat-square) ![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/jabranr/postcodes-io?style=flat-square)

PostcodesIO is a PHP library for postcodes.io API.

# Install

Install using composer:

```
$ composer require jabranr/postcodes-io
```

# Documentation

All of the following methods return back the same [complete response](https://postcodes.io/docs) as it comes from postcodes.io API in JSON format.

# Development

**Prerequisites**

- Docker

- Start container: `docker-compose up`
- Run tests: `docker-compose exec postcodes_io bash -c "composer test"`

**Debugging**
Xdebug is already installed and enabled as part of the docker setup. The project includes `launch.json` debug setup file for VSCode.

#### Find postcode information

```php
use Jabranr\PostcodesIO\PostcodesIO;

$postcodesIO = new PostcodesIO();

try {
  $addresses = $postcodesIO->find('NW1 5LD');
} catch(\Exception $e) {
  echo $e->getMessage();
}
```

> You can catch specific `Jabranr\PostcodesIO\Exception\PostcodeIOException` or/and catch general `\Exception` to catch any type.

```php
use Jabranr\PostcodesIO\PostcodesIO;

$postcodesIO = new PostcodesIO('NW1 5LD');
$addresses = $postcodesIO->getResult();
```

#### Find postcode information by geo location

```php
use Jabranr\PostcodesIO\PostcodesIO;

$postcodesIO = new PostcodesIO();
$addresses = $postcodesIO->findByLocation(51.520331, -0.1396267);
```

#### Find random postcode information

```php
use Jabranr\PostcodesIO\PostcodesIO;

$postcodesIO = new PostcodesIO();
$addresses = $postcodesIO->findRandom();
```

OR use the alias method:

```php
use Jabranr\PostcodesIO\PostcodesIO;

$postcodesIO = new PostcodesIO();
$addresses = $postcodesIO->random();
```

#### Validate a postcode

```php
use Jabranr\PostcodesIO\PostcodesIO;

$postcodesIO = new PostcodesIO();
$addresses = $postcodesIO->validate('NW1 5LD');
```

#### Find nearest postcodes

```php
use Jabranr\PostcodesIO\PostcodesIO;

$postcodesIO = new PostcodesIO();
$addresses = $postcodesIO->findNearest('NW1 5LD');
```

OR use the alias method:

```php
use Jabranr\PostcodesIO\PostcodesIO;

$postcodesIO = new PostcodesIO();
$addresses = $postcodesIO->nearest();
```

#### Get an autocompleted list of a postcode/outcode

```php
use Jabranr\PostcodesIO\PostcodesIO;

$postcodesIO = new PostcodesIO();
$addresses = $postcodesIO->autocomplete('NW1');
```

#### Search a postcode

```php
use Jabranr\PostcodesIO\PostcodesIO;

$postcodesIO = new PostcodesIO();
$addresses = $postcodesIO->query('NW1 5LD');
```

OR use the alias method:

```php
use Jabranr\PostcodesIO\PostcodesIO;

$postcodesIO = new PostcodesIO();
$addresses = $postcodesIO->search('NW1 5LD');
```

#### Find an outcode

```php
use Jabranr\PostcodesIO\PostcodesIO;

$postcodesIO = new PostcodesIO();
$addresses = $postcodesIO->findOutcode('NW1');
```

#### Find nearest outcodes

```php
use Jabranr\PostcodesIO\PostcodesIO;

$postcodesIO = new PostcodesIO();
$addresses = $postcodesIO->nearestOutcode('NW1');
```

#### Find an outcode by location

```php
use Jabranr\PostcodesIO\PostcodesIO;

$postcodesIO = new PostcodesIO();
$addresses = $postcodesIO->findOutcodeByLocation(51.520331, -0.1396267);
```

#### Bulk postcodes search

```php
use Jabranr\PostcodesIO\PostcodesIO;

$postcodesIO = new PostcodesIO();
$addresses = $postcodesIO->bulkPostcodeSearch(array('NW1 5LD', 'W1T 7NY'));
```

> Maximum of 100 postcodes per request.

#### Bulk reverse geocoding

```php
use Jabranr\PostcodesIO\PostcodesIO;

$postcodesIO = new PostcodesIO();
$addresses = $postcodesIO->bulkReverseGeocoding(array(
    array(51.520331, -0.1396267),
    array(51.520331, -0.1396267)
));
```

or

```php
use Jabranr\PostcodesIO\PostcodesIO;

$postcodesIO = new PostcodesIO();
$addresses = $postcodesIO->bulkReverseGeocoding(array(
    array('latitude' => 51.520331, 'longitude' => -0.1396267),
    array('latitude' => 51.520331, 'longitude' => -0.1396267)
));
```

> Maximum of 100 geolocations per request.

# License

MIT License
&copy; 2016 &ndash; present | Jabran Rafique
