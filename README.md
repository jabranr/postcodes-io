# PostcodesIO [![Build Status](https://travis-ci.org/jabranr/postcodes-io.svg?branch=master)](https://travis-ci.org/jabranr/postcodes-io)
PostcodesIO is a PHP library for postcodes.io API.

# Install

Install using composer:

```
$ composer require jabranr/postcodes-io
```

# Documentation

All of the following methods returnn back the same [complete response]() as it comes from postcodes.io API in JSON format.

> Use `try, catch` to make requests and capture exceptions in case of failure.

#### Find postcode information

```php
$postcodeFinder = new PostcodesIO();
$addresses = $postcodeFinder->find('NW1 5LD');
```

```php
$postcodeFinder = new PostcodesIO('NW1 5LD');
$addresses = $postcodeFinder->getResult();
```

#### Find postcode information by geo location

```php
$postcodeFinder = new PostcodesIO();
$addresses = $postcodeFinder->findByLocation(51.520331, -0.1396267);
```

#### Find random postcode information

```php
$postcodeFinder = new PostcodesIO();
$addresses = $postcodeFinder->findRandom();
```
OR use the alias method:

```php
$postcodeFinder = new PostcodesIO();
$addresses = $postcodeFinder->random();
```

#### Validate a postcode

```php
$postcodeFinder = new PostcodesIO();
$addresses = $postcodeFinder->validate('NW1 5LD');
```

#### Find nearest postcodes

```php
$postcodeFinder = new PostcodesIO();
$addresses = $postcodeFinder->findNearest('NW1 5LD');
```

OR use the alias method:

```php
$postcodeFinder = new PostcodesIO();
$addresses = $postcodeFinder->nearest();
```

#### Get an autocompleted list of a postcode/outcode

```php
$postcodeFinder = new PostcodesIO();
$addresses = $postcodeFinder->autocomplete('NW1');
```

#### Search a postcode

```php
$postcodeFinder = new PostcodesIO();
$addresses = $postcodeFinder->query('NW1 5LD');
```

OR use the alias method:

```php
$postcodeFinder = new PostcodesIO();
$addresses = $postcodeFinder->search('NW1 5LD');
```

#### Find an outcode

```php
$postcodeFinder = new PostcodesIO();
$addresses = $postcodeFinder->findOutcode('NW1');
```

#### Find nearest outcodes

```php
$postcodeFinder = new PostcodesIO();
$addresses = $postcodeFinder->nearestOutcode('NW1');
```

#### Find an outcode by location

```php
$postcodeFinder = new PostcodesIO();
$addresses = $postcodeFinder->findOutcodeByLocation(51.520331, -0.1396267);
```

#### Bulk postcodes search

```php
$postcodeFinder = new PostcodesIO();
$addresses = $postcodeFinder->bulkPostcodeSearch(array('NW1 5LD', 'W1T 7NY'));
```

> Maximum of 100 postcodes per request.


#### Bulk reverse geocoding

```php
$postcodeFinder = new PostcodesIO();
$addresses = $postcodeFinder->bulkReverseGeocoding(array(
    array(51.520331, -0.1396267),
    array(51.520331, -0.1396267)
));
```

> Maximum of 100 geolocations per request.


# License
MIT License
&copy; 2016 &ndash; Jabran Rafique
