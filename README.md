# Rei Do Almoço

## Installation

1. Download [Composer](https://getcomposer.org/doc/00-intro.md) or update `composer self-update`.
2. Run "php composer.phar install".
3. Run "bin/cake migrations migrate"

You can now either use your machine's webserver to view the default home page, or start
up the built-in webserver with:
1. Run "bin/cake server -p 8765"
2. Then visit `http://localhost:8765` to see the home page.

To run the unit test:
1. Run "vendor/bin/phpunit"