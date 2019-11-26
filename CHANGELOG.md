# Changelog

All Notable changes to `digipolisgent/flanders-basicregisters` package.

## [Unreleased]

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

[Unreleased]: https://github.com/digipolisgent/php_package_dg-flanders-basicregisters/compare/master...develop
[1.0.0]: https://github.com/digipolisgent/php_package_dg-flanders-basicregisters/releases/tag/0.1.0
