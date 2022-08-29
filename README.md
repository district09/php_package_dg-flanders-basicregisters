# digipolisgent/flanders-basicregisters package

Provides a library to communicate with the Flanders Basic Registers
([Vlaanderen Basisregisters][flanders-basicregister.api]) API. This api
contains information about addresses and buildings in Flanders (Belgium).

It also contains the value objects wrapping the returned data.

[![Github][github-badge]][github-link]

[![Build Status Master][travis-master-badge]][travis-master-link]
[![Build Status Develop][travis-develop-badge]][travis-develop-link]
[![Maintainability][codeclimate-maint-badge]][codeclimate-maint-link]
[![Test Coverage][codeclimate-cover-badge]][codeclimate-cover-link]

## Install

Install the package using composer:

```bash
composer require digipolisgent/flanders-basicregister
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed
recently.

## Examples

See the [examples](examples) directory how to use the service wrappers.

## Testing

Run the test suite:

``` bash
vendor/bin/phpunit
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more
information.

[flanders-basicregister.api]: https://overheid.vlaanderen.be/producten-diensten/gebouwen-adressenregister

[github-badge]: https://img.shields.io/badge/github-DigipolisGent_Flanders_BasicRegisters-blue.svg?logo=github
[github-link]: https://github.com/district09/php_package_dg-flanders-basicregisters

[travis-master-badge]: https://app.travis-ci.com/district09/php_package_dg-flanders-basicregisters.svg?token=anXPs46DEwgxP8RmJPAJ&branch=main "Travis build master"
[travis-master-link]: https://app.travis-ci.com/district09/php_package_dg-flanders-basicregisters/branches
[travis-develop-badge]: https://app.travis-ci.com/district09/php_package_dg-flanders-basicregisters.svg?token=anXPs46DEwgxP8RmJPAJ&branch=develop "Travis build develop"
[travis-develop-link]: https://app.travis-ci.com/district09/php_package_dg-flanders-basicregisters/branches

[codeclimate-maint-badge]: https://api.codeclimate.com/v1/badges/8bfb24263542eebef97a/maintainability
[codeclimate-maint-link]: https://codeclimate.com/github/district09/php_package_dg-flanders-basicregisters/maintainability
[codeclimate-cover-badge]: https://api.codeclimate.com/v1/badges/8bfb24263542eebef97a/test_coverage
[codeclimate-cover-link]: https://codeclimate.com/github/district09/php_package_dg-flanders-basicregisters/test_coverage
