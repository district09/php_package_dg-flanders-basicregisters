# Changelog

All Notable changes to `digipolisgent/flanders-basicregisters` package.

## [3.0.0]

### Fixed

* Since March 24 the V1 API has been deprecated and in the V2,
  the Lambert72 point value has been changed to a XML type string.

### Updated

* phpunit tests with the new API responses.

## [2.0.0]

### Added

* Add support for PHP 8.x.

### Updated

* Update digipolisgent/api-client to 3.x.
* Update digipolisgent/value to 3.x.

### Changed

* Change minimal PHP version to PHP 7.4.

## [1.0.0]

### Added

* Add qa-php package to validate code quality.

### Changed

* Change minimal PHP version to 7.3.

## [0.2.3]

### Fixed

* Fixed including empty filters in the query string.
  When a filter was added with a NULL value, then the filter key was not added
  to the query string.

## [0.2.2]

### Added

* Added method to PostInfoNames to get all names at once.
  The post info names object contains all PostInfoName objects at once
  including the main name and sub-municipality names. There are use cases
  where an array of all names, starting with the main name, are required.

### Changed

* The main name is written in all caps. That name is now transformed into
  Capitalized Words.

## [0.2.1]

### Changed

* Changed extending the interface by the BasicRegisterInterface instead of the
  BasicRegister class.

## [0.2.0]

### Added

* Added injectable caching and logging to the services.
* Added caching of the services detail method results.

### Fixed

* Allowed Client exceptions to bubble up.

## [0.1.1]

### Added

* Added backwards compatibility for older Value & Api-Client packages.
  This to avoid dependency issues when combined with other packages.

## [0.1.0]

Initial release of the Flanders Basic Registers client package.

Not all methods are covered (yet).

Covered:

* Addresses : list, detail, and match.
* MunicipalityName : list and detail.
* StreetName : list and detail.
* PostPoint : list and detail.

### Added

* Added the Municipality value.
* Added the StreetName value.
* Added the AddressPoint values.
* Added the Addresses collection.
* Added the AddressDetail value.
* Added the AddressMatches collection and related objects.
* Added the PostInfo value and collection.
* Added the MunicipalityNames collection.
* Added the StreetNames collection.
* Added the GeographicalNameNormalizer.
* Added the GeographicalNamesNormalizer.
* Added the StreetNameDetailNormalizer.
* Added the StreetNameNormalizer.
* Added the StreetNamesNormalizer.
* Added the MunicipalityNameNormalizer.
* Added the MunicipalityNamesNormalizer.
* Added the MunicipalityNameDetailNormalizer.
* Added the PostInfoNormalizer.
* Added the PostInfosNormalizer.
* Added the FullAddressNormalizer.
* Added the AddressNormalizer.
* Added the AddressesNormalizer.
* Added the MunicipalityNormalizer.
* Added the Lambert72PointNormalizer.
* Added the AddressDetailNormalizer.
* Added the AddressMatchNormalizer.
* Added the AddressMatchesNormalizer.
* Added the Configuration.
* Added service method to get a list of Addresses.
* Added service method to get the details of a single address.
* Added service method to get (partial) addresses that match filter(s).
* Added service method to get a list of municipality names.
* Added service method to get the details of a single municipality name.
* Added service method to get a list of street names.
* Added service method to get the details of a single street name.
* Added service method to get the list of post info values.
* Added service method to get the details of a single post info value.

[2.0.0]: https://github.com/district09/php_package_dg-flanders-basicregisters/compare/1.0.0...2.0.0
[1.0.0]: https://github.com/district09/php_package_dg-flanders-basicregisters/compare/0.2.3...1.0.0
[0.2.3]: https://github.com/district09/php_package_dg-flanders-basicregisters/compare/0.2.2...0.2.3
[0.2.2]: https://github.com/district09/php_package_dg-flanders-basicregisters/compare/0.2.1...0.2.2
[0.2.1]: https://github.com/district09/php_package_dg-flanders-basicregisters/compare/0.2.0...0.2.1
[0.2.0]: https://github.com/district09/php_package_dg-flanders-basicregisters/compare/0.1.1...0.2.0
[0.1.1]: https://github.com/district09/php_package_dg-flanders-basicregisters/compare/0.1.0...0.1.1
[0.1.0]: https://github.com/district09/php_package_dg-flanders-basicregisters/releases/tag/0.1.0
[Unreleased]: https://github.com/district09/php_package_dg-flanders-basicregisters/compare/main...develop
