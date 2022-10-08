#!/usr/bin/env bash

# install dependencies
composer install -v --no-interaction --prefer-source

# run unit tests
composer test
