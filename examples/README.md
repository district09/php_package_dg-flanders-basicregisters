# Flanders Basic register : Examples

This directory contains examples of how to use the 
`\DigipolisGent\Flanders\BasicRegisters` package and to retrieve data
from the "[Vlaanderen Basisregisters][flanders-basicregister.api]"
service.

## Install

The examples require the `config.php` file being in place and filled in.

Copy the `config.example.php` file to `config.php` and fill in the
values. Do not alter the example scripts, all variables are defined in
the `config.php` file.

Install the libraries:

```bash
composer install
```

## Examples

### Addresses

* `101-AddressList.php` : Overview of the first 20 addresses in the
  register.
* `102-AddressListFilterd.php` : Overview of addresses based on given
  filter.
* `111-AddressMatch.php` : Look up an address by municipality name,
  street name, and optional house number and bus number. 
* `121-AddressDetails.php` : All details of a single address.

### Municipalities

* `201-MunicipalityNames.php` : List of the first 25 municipality names.

## Usage

The scripts can only be called from command line.

Example:

```bash
php 101-AddressList.php
```

[flanders-basicregister.api]: https://overheid.vlaanderen.be/producten-diensten/gebouwen-adressenregister
