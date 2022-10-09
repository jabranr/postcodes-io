#!/usr/bin/env bash

# validate composer.json file
echo -e "\n"
echo "Validate composer.json"
echo "========================"
composer validate

# install dependencies
echo -e "\n"
echo "Install dependencies"
echo "========================"
composer install -v --no-interaction --prefer-source

# run unit tests
echo -e "\n"
echo "Run tests"
echo "========================"
composer test
