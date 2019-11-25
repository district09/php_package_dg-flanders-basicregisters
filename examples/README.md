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
* `211-MunicipalityNameDetail.php` : All details of a single
  municipality name.
  
### Street names

* `301-StreetNameList.php` : List of the first 20 street names.
* `302-StreetNameListFiltered.php` : List of the street names filtered
  by their municipality name.
* `311-StreetNameDetail.php` : All details of a single street name.

### Post info

* `401-PostInfoList.php` : List of the first 25 post info items.
* `402-PostInfoListFiltered.php` : List of all post info items filtered by
  municipality name.
* `411-PostInfoDetail.php` : All details of a single post info. 

## Usage

The scripts can only be called from command line.

Example:

```bash
php 101-AddressList.php
```

[flanders-basicregister.api]: https://overheid.vlaanderen.be/producten-diensten/gebouwen-adressenregister
