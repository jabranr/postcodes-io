#!/usr/bin/env bash

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

tail -f /dev/null
