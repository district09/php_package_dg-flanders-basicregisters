<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson\Address;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Address\AddressMatchesNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\Address;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetail;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatch;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatches;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\FullAddress;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\Municipality;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\Position\Lambert72Point;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Address\AddressMatchesNormalizer
 */
class AddressMatchesNormalizerTest extends TestCase
{
    /**
     * Json data to test with.
     *
     * @var string
     */
    private $json = <<<EOT
    {
        "@context": "https://docs.basisregisters.vlaanderen.be/context/adresmatch/2023-03-13/adresmatch.jsonld",
        "adresMatches": [
          {
            "@type": "Adres",
            "identificator": {
              "id": "https://data.vlaanderen.be/id/adres/3281807",
              "naamruimte": "https://data.vlaanderen.be/id/adres",
              "objectId": "3281807",
              "versieId": "2023-11-01T12:12:49+01:00"
            },
            "detail": "https://api.basisregisters.vlaanderen.be/v2/adressen/3281807",
            "gemeente": {
              "objectId": "44021",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/gemeenten/44021",
              "gemeentenaam": {
                "geografischeNaam": {
                  "spelling": "Gent",
                  "taal": "nl"
                }
              }
            },
            "postinfo": {
              "objectId": "9050",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/postinfo/9050"
            },
            "straatnaam": {
              "objectId": "69683",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/straatnamen/69683",
              "straatnaam": {
                "geografischeNaam": {
                  "spelling": "Bellevue",
                  "taal": "nl"
                }
              }
            },
            "huisnummer": "5",
            "volledigAdres": {
              "geografischeNaam": {
                "spelling": "Bellevue 5, 9050 Gent",
                "taal": "nl"
              }
            },
            "adresPositie": {
              "geometrie": {
                "type": "Point",
                "gml": "\u003Cgml:Point srsName=\"https://www.opengis.net/def/crs/EPSG/0/31370\" xmlns:gml=\"http://www.opengis.net/gml/3.2\"\u003E\u003Cgml:pos\u003E105665.73 192054.51\u003C/gml:pos\u003E\u003C/gml:Point\u003E"
              },
              "positieGeometrieMethode": "aangeduidDoorBeheerder",
              "positieSpecificatie": "gebouweenheid"
            },
            "adresStatus": "inGebruik",
            "officieelToegekend": true,
            "score": 100,
            "links": [
              {
                "href": "https://api.basisregisters.vlaanderen.be/v2/percelen?adresobjectid=3281807",
                "rel": "percelen",
                "type": "GET"
              },
              {
                "href": "https://api.basisregisters.vlaanderen.be/v2/gebouweenheden?adresobjectid=3281807",
                "rel": "gebouweenheden",
                "type": "GET"
              }
            ]
          },
          {
            "@type": "Adres",
            "identificator": {
              "id": "https://data.vlaanderen.be/id/adres/5309354",
              "naamruimte": "https://data.vlaanderen.be/id/adres",
              "objectId": "5309354",
              "versieId": "2023-11-01T19:55:16+01:00"
            },
            "detail": "https://api.basisregisters.vlaanderen.be/v2/adressen/5309354",
            "gemeente": {
              "objectId": "44021",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/gemeenten/44021",
              "gemeentenaam": {
                "geografischeNaam": {
                  "spelling": "Gent",
                  "taal": "nl"
                }
              }
            },
            "postinfo": {
              "objectId": "9050",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/postinfo/9050"
            },
            "straatnaam": {
              "objectId": "69683",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/straatnamen/69683",
              "straatnaam": {
                "geografischeNaam": {
                  "spelling": "Bellevue",
                  "taal": "nl"
                }
              }
            },
            "huisnummer": "5",
            "busnummer": "0001",
            "volledigAdres": {
              "geografischeNaam": {
                "spelling": "Bellevue 5 bus 0001, 9050 Gent",
                "taal": "nl"
              }
            },
            "adresPositie": {
              "geometrie": {
                "type": "Point",
                "gml": "\u003Cgml:Point srsName=\"https://www.opengis.net/def/crs/EPSG/0/31370\" xmlns:gml=\"http://www.opengis.net/gml/3.2\"\u003E\u003Cgml:pos\u003E105652.79 192086.26\u003C/gml:pos\u003E\u003C/gml:Point\u003E"
              },
              "positieGeometrieMethode": "aangeduidDoorBeheerder",
              "positieSpecificatie": "gebouweenheid"
            },
            "adresStatus": "inGebruik",
            "officieelToegekend": true,
            "score": 88.1244881244881,
            "links": [
              {
                "href": "https://api.basisregisters.vlaanderen.be/v2/percelen?adresobjectid=5309354",
                "rel": "percelen",
                "type": "GET"
              },
              {
                "href": "https://api.basisregisters.vlaanderen.be/v2/gebouweenheden?adresobjectid=5309354",
                "rel": "gebouweenheden",
                "type": "GET"
              }
            ]
          },
          {
            "@type": "Adres",
            "identificator": {
              "id": "https://data.vlaanderen.be/id/adres/5309111",
              "naamruimte": "https://data.vlaanderen.be/id/adres",
              "objectId": "5309111",
              "versieId": "2023-11-01T19:55:08+01:00"
            },
            "detail": "https://api.basisregisters.vlaanderen.be/v2/adressen/5309111",
            "gemeente": {
              "objectId": "44021",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/gemeenten/44021",
              "gemeentenaam": {
                "geografischeNaam": {
                  "spelling": "Gent",
                  "taal": "nl"
                }
              }
            },
            "postinfo": {
              "objectId": "9050",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/postinfo/9050"
            },
            "straatnaam": {
              "objectId": "69683",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/straatnamen/69683",
              "straatnaam": {
                "geografischeNaam": {
                  "spelling": "Bellevue",
                  "taal": "nl"
                }
              }
            },
            "huisnummer": "5",
            "busnummer": "0005",
            "volledigAdres": {
              "geografischeNaam": {
                "spelling": "Bellevue 5 bus 0005, 9050 Gent",
                "taal": "nl"
              }
            },
            "adresPositie": {
              "geometrie": {
                "type": "Point",
                "gml": "\u003Cgml:Point srsName=\"https://www.opengis.net/def/crs/EPSG/0/31370\" xmlns:gml=\"http://www.opengis.net/gml/3.2\"\u003E\u003Cgml:pos\u003E105652.79 192086.26\u003C/gml:pos\u003E\u003C/gml:Point\u003E"
              },
              "positieGeometrieMethode": "aangeduidDoorBeheerder",
              "positieSpecificatie": "gebouweenheid"
            },
            "adresStatus": "inGebruik",
            "officieelToegekend": true,
            "score": 88.1244881244881,
            "links": [
              {
                "href": "https://api.basisregisters.vlaanderen.be/v2/percelen?adresobjectid=5309111",
                "rel": "percelen",
                "type": "GET"
              },
              {
                "href": "https://api.basisregisters.vlaanderen.be/v2/gebouweenheden?adresobjectid=5309111",
                "rel": "gebouweenheden",
                "type": "GET"
              }
            ]
          },
          {
            "@type": "Adres",
            "identificator": {
              "id": "https://data.vlaanderen.be/id/adres/5300700",
              "naamruimte": "https://data.vlaanderen.be/id/adres",
              "objectId": "5300700",
              "versieId": "2023-11-01T19:54:37+01:00"
            },
            "detail": "https://api.basisregisters.vlaanderen.be/v2/adressen/5300700",
            "gemeente": {
              "objectId": "44021",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/gemeenten/44021",
              "gemeentenaam": {
                "geografischeNaam": {
                  "spelling": "Gent",
                  "taal": "nl"
                }
              }
            },
            "postinfo": {
              "objectId": "9050",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/postinfo/9050"
            },
            "straatnaam": {
              "objectId": "69683",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/straatnamen/69683",
              "straatnaam": {
                "geografischeNaam": {
                  "spelling": "Bellevue",
                  "taal": "nl"
                }
              }
            },
            "huisnummer": "5",
            "busnummer": "0101",
            "volledigAdres": {
              "geografischeNaam": {
                "spelling": "Bellevue 5 bus 0101, 9050 Gent",
                "taal": "nl"
              }
            },
            "adresPositie": {
              "geometrie": {
                "type": "Point",
                "gml": "\u003Cgml:Point srsName=\"https://www.opengis.net/def/crs/EPSG/0/31370\" xmlns:gml=\"http://www.opengis.net/gml/3.2\"\u003E\u003Cgml:pos\u003E105652.79 192086.26\u003C/gml:pos\u003E\u003C/gml:Point\u003E"
              },
              "positieGeometrieMethode": "aangeduidDoorBeheerder",
              "positieSpecificatie": "gebouweenheid"
            },
            "adresStatus": "inGebruik",
            "officieelToegekend": true,
            "score": 88.1244881244881,
            "links": [
              {
                "href": "https://api.basisregisters.vlaanderen.be/v2/percelen?adresobjectid=5300700",
                "rel": "percelen",
                "type": "GET"
              },
              {
                "href": "https://api.basisregisters.vlaanderen.be/v2/gebouweenheden?adresobjectid=5300700",
                "rel": "gebouweenheden",
                "type": "GET"
              }
            ]
          },
          {
            "@type": "Adres",
            "identificator": {
              "id": "https://data.vlaanderen.be/id/adres/5350009",
              "naamruimte": "https://data.vlaanderen.be/id/adres",
              "objectId": "5350009",
              "versieId": "2023-11-01T19:56:34+01:00"
            },
            "detail": "https://api.basisregisters.vlaanderen.be/v2/adressen/5350009",
            "gemeente": {
              "objectId": "44021",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/gemeenten/44021",
              "gemeentenaam": {
                "geografischeNaam": {
                  "spelling": "Gent",
                  "taal": "nl"
                }
              }
            },
            "postinfo": {
              "objectId": "9050",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/postinfo/9050"
            },
            "straatnaam": {
              "objectId": "69683",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/straatnamen/69683",
              "straatnaam": {
                "geografischeNaam": {
                  "spelling": "Bellevue",
                  "taal": "nl"
                }
              }
            },
            "huisnummer": "5",
            "busnummer": "0201",
            "volledigAdres": {
              "geografischeNaam": {
                "spelling": "Bellevue 5 bus 0201, 9050 Gent",
                "taal": "nl"
              }
            },
            "adresPositie": {
              "geometrie": {
                "type": "Point",
                "gml": "\u003Cgml:Point srsName=\"https://www.opengis.net/def/crs/EPSG/0/31370\" xmlns:gml=\"http://www.opengis.net/gml/3.2\"\u003E\u003Cgml:pos\u003E105652.79 192086.26\u003C/gml:pos\u003E\u003C/gml:Point\u003E"
              },
              "positieGeometrieMethode": "aangeduidDoorBeheerder",
              "positieSpecificatie": "gebouweenheid"
            },
            "adresStatus": "inGebruik",
            "officieelToegekend": true,
            "score": 88.1244881244881,
            "links": [
              {
                "href": "https://api.basisregisters.vlaanderen.be/v2/percelen?adresobjectid=5350009",
                "rel": "percelen",
                "type": "GET"
              },
              {
                "href": "https://api.basisregisters.vlaanderen.be/v2/gebouweenheden?adresobjectid=5350009",
                "rel": "gebouweenheden",
                "type": "GET"
              }
            ]
          },
          {
            "@type": "Adres",
            "identificator": {
              "id": "https://data.vlaanderen.be/id/adres/5259525",
              "naamruimte": "https://data.vlaanderen.be/id/adres",
              "objectId": "5259525",
              "versieId": "2023-11-01T19:51:44+01:00"
            },
            "detail": "https://api.basisregisters.vlaanderen.be/v2/adressen/5259525",
            "gemeente": {
              "objectId": "44021",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/gemeenten/44021",
              "gemeentenaam": {
                "geografischeNaam": {
                  "spelling": "Gent",
                  "taal": "nl"
                }
              }
            },
            "postinfo": {
              "objectId": "9050",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/postinfo/9050"
            },
            "straatnaam": {
              "objectId": "69683",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/straatnamen/69683",
              "straatnaam": {
                "geografischeNaam": {
                  "spelling": "Bellevue",
                  "taal": "nl"
                }
              }
            },
            "huisnummer": "5",
            "busnummer": "0301",
            "volledigAdres": {
              "geografischeNaam": {
                "spelling": "Bellevue 5 bus 0301, 9050 Gent",
                "taal": "nl"
              }
            },
            "adresPositie": {
              "geometrie": {
                "type": "Point",
                "gml": "\u003Cgml:Point srsName=\"https://www.opengis.net/def/crs/EPSG/0/31370\" xmlns:gml=\"http://www.opengis.net/gml/3.2\"\u003E\u003Cgml:pos\u003E105652.79 192086.26\u003C/gml:pos\u003E\u003C/gml:Point\u003E"
              },
              "positieGeometrieMethode": "aangeduidDoorBeheerder",
              "positieSpecificatie": "gebouweenheid"
            },
            "adresStatus": "inGebruik",
            "officieelToegekend": true,
            "score": 88.1244881244881,
            "links": [
              {
                "href": "https://api.basisregisters.vlaanderen.be/v2/percelen?adresobjectid=5259525",
                "rel": "percelen",
                "type": "GET"
              },
              {
                "href": "https://api.basisregisters.vlaanderen.be/v2/gebouweenheden?adresobjectid=5259525",
                "rel": "gebouweenheden",
                "type": "GET"
              }
            ]
          },
          {
            "@type": "Adres",
            "identificator": {
              "id": "https://data.vlaanderen.be/id/adres/5350010",
              "naamruimte": "https://data.vlaanderen.be/id/adres",
              "objectId": "5350010",
              "versieId": "2023-11-01T19:56:34+01:00"
            },
            "detail": "https://api.basisregisters.vlaanderen.be/v2/adressen/5350010",
            "gemeente": {
              "objectId": "44021",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/gemeenten/44021",
              "gemeentenaam": {
                "geografischeNaam": {
                  "spelling": "Gent",
                  "taal": "nl"
                }
              }
            },
            "postinfo": {
              "objectId": "9050",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/postinfo/9050"
            },
            "straatnaam": {
              "objectId": "69683",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/straatnamen/69683",
              "straatnaam": {
                "geografischeNaam": {
                  "spelling": "Bellevue",
                  "taal": "nl"
                }
              }
            },
            "huisnummer": "5",
            "busnummer": "0302",
            "volledigAdres": {
              "geografischeNaam": {
                "spelling": "Bellevue 5 bus 0302, 9050 Gent",
                "taal": "nl"
              }
            },
            "adresPositie": {
              "geometrie": {
                "type": "Point",
                "gml": "\u003Cgml:Point srsName=\"https://www.opengis.net/def/crs/EPSG/0/31370\" xmlns:gml=\"http://www.opengis.net/gml/3.2\"\u003E\u003Cgml:pos\u003E105652.79 192086.26\u003C/gml:pos\u003E\u003C/gml:Point\u003E"
              },
              "positieGeometrieMethode": "aangeduidDoorBeheerder",
              "positieSpecificatie": "gebouweenheid"
            },
            "adresStatus": "inGebruik",
            "officieelToegekend": true,
            "score": 88.1244881244881,
            "links": [
              {
                "href": "https://api.basisregisters.vlaanderen.be/v2/percelen?adresobjectid=5350010",
                "rel": "percelen",
                "type": "GET"
              },
              {
                "href": "https://api.basisregisters.vlaanderen.be/v2/gebouweenheden?adresobjectid=5350010",
                "rel": "gebouweenheden",
                "type": "GET"
              }
            ]
          },
          {
            "@type": "Adres",
            "identificator": {
              "id": "https://data.vlaanderen.be/id/adres/5309355",
              "naamruimte": "https://data.vlaanderen.be/id/adres",
              "objectId": "5309355",
              "versieId": "2023-11-01T19:55:16+01:00"
            },
            "detail": "https://api.basisregisters.vlaanderen.be/v2/adressen/5309355",
            "gemeente": {
              "objectId": "44021",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/gemeenten/44021",
              "gemeentenaam": {
                "geografischeNaam": {
                  "spelling": "Gent",
                  "taal": "nl"
                }
              }
            },
            "postinfo": {
              "objectId": "9050",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/postinfo/9050"
            },
            "straatnaam": {
              "objectId": "69683",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/straatnamen/69683",
              "straatnaam": {
                "geografischeNaam": {
                  "spelling": "Bellevue",
                  "taal": "nl"
                }
              }
            },
            "huisnummer": "5",
            "busnummer": "0601",
            "volledigAdres": {
              "geografischeNaam": {
                "spelling": "Bellevue 5 bus 0601, 9050 Gent",
                "taal": "nl"
              }
            },
            "adresPositie": {
              "geometrie": {
                "type": "Point",
                "gml": "\u003Cgml:Point srsName=\"https://www.opengis.net/def/crs/EPSG/0/31370\" xmlns:gml=\"http://www.opengis.net/gml/3.2\"\u003E\u003Cgml:pos\u003E105652.79 192086.26\u003C/gml:pos\u003E\u003C/gml:Point\u003E"
              },
              "positieGeometrieMethode": "aangeduidDoorBeheerder",
              "positieSpecificatie": "gebouweenheid"
            },
            "adresStatus": "inGebruik",
            "officieelToegekend": true,
            "score": 88.1244881244881,
            "links": [
              {
                "href": "https://api.basisregisters.vlaanderen.be/v2/percelen?adresobjectid=5309355",
                "rel": "percelen",
                "type": "GET"
              },
              {
                "href": "https://api.basisregisters.vlaanderen.be/v2/gebouweenheden?adresobjectid=5309355",
                "rel": "gebouweenheden",
                "type": "GET"
              }
            ]
          },
          {
            "@type": "Adres",
            "identificator": {
              "id": "https://data.vlaanderen.be/id/adres/5350011",
              "naamruimte": "https://data.vlaanderen.be/id/adres",
              "objectId": "5350011",
              "versieId": "2023-11-01T19:56:34+01:00"
            },
            "detail": "https://api.basisregisters.vlaanderen.be/v2/adressen/5350011",
            "gemeente": {
              "objectId": "44021",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/gemeenten/44021",
              "gemeentenaam": {
                "geografischeNaam": {
                  "spelling": "Gent",
                  "taal": "nl"
                }
              }
            },
            "postinfo": {
              "objectId": "9050",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/postinfo/9050"
            },
            "straatnaam": {
              "objectId": "69683",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/straatnamen/69683",
              "straatnaam": {
                "geografischeNaam": {
                  "spelling": "Bellevue",
                  "taal": "nl"
                }
              }
            },
            "huisnummer": "5",
            "busnummer": "0701",
            "volledigAdres": {
              "geografischeNaam": {
                "spelling": "Bellevue 5 bus 0701, 9050 Gent",
                "taal": "nl"
              }
            },
            "adresPositie": {
              "geometrie": {
                "type": "Point",
                "gml": "\u003Cgml:Point srsName=\"https://www.opengis.net/def/crs/EPSG/0/31370\" xmlns:gml=\"http://www.opengis.net/gml/3.2\"\u003E\u003Cgml:pos\u003E105652.79 192086.26\u003C/gml:pos\u003E\u003C/gml:Point\u003E"
              },
              "positieGeometrieMethode": "aangeduidDoorBeheerder",
              "positieSpecificatie": "gebouweenheid"
            },
            "adresStatus": "inGebruik",
            "officieelToegekend": true,
            "score": 88.1244881244881,
            "links": [
              {
                "href": "https://api.basisregisters.vlaanderen.be/v2/percelen?adresobjectid=5350011",
                "rel": "percelen",
                "type": "GET"
              },
              {
                "href": "https://api.basisregisters.vlaanderen.be/v2/gebouweenheden?adresobjectid=5350011",
                "rel": "gebouweenheden",
                "type": "GET"
              }
            ]
          },
          {
            "@type": "Adres",
            "identificator": {
              "id": "https://data.vlaanderen.be/id/adres/5325904",
              "naamruimte": "https://data.vlaanderen.be/id/adres",
              "objectId": "5325904",
              "versieId": "2023-11-01T19:49:45+01:00"
            },
            "detail": "https://api.basisregisters.vlaanderen.be/v2/adressen/5325904",
            "gemeente": {
              "objectId": "44021",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/gemeenten/44021",
              "gemeentenaam": {
                "geografischeNaam": {
                  "spelling": "Gent",
                  "taal": "nl"
                }
              }
            },
            "postinfo": {
              "objectId": "9050",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/postinfo/9050"
            },
            "straatnaam": {
              "objectId": "69683",
              "detail": "https://api.basisregisters.vlaanderen.be/v2/straatnamen/69683",
              "straatnaam": {
                "geografischeNaam": {
                  "spelling": "Bellevue",
                  "taal": "nl"
                }
              }
            },
            "huisnummer": "5",
            "busnummer": "0801",
            "volledigAdres": {
              "geografischeNaam": {
                "spelling": "Bellevue 5 bus 0801, 9050 Gent",
                "taal": "nl"
              }
            },
            "adresPositie": {
              "geometrie": {
                "type": "Point",
                "gml": "\u003Cgml:Point srsName=\"https://www.opengis.net/def/crs/EPSG/0/31370\" xmlns:gml=\"http://www.opengis.net/gml/3.2\"\u003E\u003Cgml:pos\u003E105652.79 192086.26\u003C/gml:pos\u003E\u003C/gml:Point\u003E"
              },
              "positieGeometrieMethode": "aangeduidDoorBeheerder",
              "positieSpecificatie": "gebouweenheid"
            },
            "adresStatus": "inGebruik",
            "officieelToegekend": true,
            "score": 88.1244881244881,
            "links": [
              {
                "href": "https://api.basisregisters.vlaanderen.be/v2/percelen?adresobjectid=5325904",
                "rel": "percelen",
                "type": "GET"
              },
              {
                "href": "https://api.basisregisters.vlaanderen.be/v2/gebouweenheden?adresobjectid=5325904",
                "rel": "gebouweenheden",
                "type": "GET"
              }
            ]
          }
        ],
        "warnings": []
      }
EOT;

    /**
     * Json data is normalized into an AddressMatches collection.
     *
     * @test
     */
    public function jsonDataIsNormalized(): void
    {
        $expected = new AddressMatches(
            new AddressMatch(
                new MunicipalityName(
                    new MunicipalityNameId(44021),
                    new GeographicalName(
                        new LanguageCode('NL'),
                        'Gent'
                    )
                ),
                new StreetName(
                    new StreetNameId(69683),
                    new GeographicalName(
                        new LanguageCode('NL'),
                        'Bellevue'
                    )
                ),
                new AddressDetail(
                    new Address(
                        new AddressId(3281807),
                        '5',
                        '',
                        $expected = new FullAddress(
                            new LanguageCode('NL'),
                            'Bellevue 5, 9050 Gent'
                        )
                    ),
                    new Municipality(
                        new PostInfoId(9050),
                        new MunicipalityName(
                            new MunicipalityNameId(44021),
                            new GeographicalName(
                                new LanguageCode('NL'),
                                'Gent'
                            )
                        )
                    ),
                    new StreetName(
                        new StreetNameId(69683),
                        new GeographicalName(
                            new LanguageCode('NL'),
                            'Bellevue'
                        )
                    ),
                    new Lambert72Point(105665.73, 192054.51)
                ),
                100.0
            ),
            new AddressMatch(
                new MunicipalityName(
                    new MunicipalityNameId(44021),
                    new GeographicalName(
                        new LanguageCode('NL'),
                        'Gent'
                    )
                ),
                new StreetName(
                    new StreetNameId(69683),
                    new GeographicalName(
                        new LanguageCode('NL'),
                        'Bellevue'
                    )
                ),
                new AddressDetail(
                    new Address(
                        new AddressId(5309354),
                        '5',
                        '0001',
                        $expected = new FullAddress(
                            new LanguageCode('NL'),
                            'Bellevue 5 bus 0001, 9050 Gent'
                        )
                    ),
                    new Municipality(
                        new PostInfoId(9050),
                        new MunicipalityName(
                            new MunicipalityNameId(44021),
                            new GeographicalName(
                                new LanguageCode('NL'),
                                'Gent'
                            )
                        )
                    ),
                    new StreetName(
                        new StreetNameId(69683),
                        new GeographicalName(
                            new LanguageCode('NL'),
                            'Bellevue'
                        )
                    ),
                    new Lambert72Point(105652.79, 192086.26)
                ),
                88.1244881244881
            ),
            new AddressMatch(
                new MunicipalityName(
                    new MunicipalityNameId(44021),
                    new GeographicalName(
                        new LanguageCode('NL'),
                        'Gent'
                    )
                ),
                new StreetName(
                    new StreetNameId(69683),
                    new GeographicalName(
                        new LanguageCode('NL'),
                        'Bellevue'
                    )
                ),
                new AddressDetail(
                    new Address(
                        new AddressId(5309111),
                        '5',
                        '0005',
                        $expected = new FullAddress(
                            new LanguageCode('NL'),
                            'Bellevue 5 bus 0005, 9050 Gent'
                        )
                    ),
                    new Municipality(
                        new PostInfoId(9050),
                        new MunicipalityName(
                            new MunicipalityNameId(44021),
                            new GeographicalName(
                                new LanguageCode('NL'),
                                'Gent'
                            )
                        )
                    ),
                    new StreetName(
                        new StreetNameId(69683),
                        new GeographicalName(
                            new LanguageCode('NL'),
                            'Bellevue'
                        )
                    ),
                    new Lambert72Point(105652.79, 192086.26)
                ),
                88.1244881244881
            ),
            new AddressMatch(
                new MunicipalityName(
                    new MunicipalityNameId(44021),
                    new GeographicalName(
                        new LanguageCode('NL'),
                        'Gent'
                    )
                ),
                new StreetName(
                    new StreetNameId(69683),
                    new GeographicalName(
                        new LanguageCode('NL'),
                        'Bellevue'
                    )
                ),
                new AddressDetail(
                    new Address(
                        new AddressId(5300700),
                        '5',
                        '0101',
                        $expected = new FullAddress(
                            new LanguageCode('NL'),
                            'Bellevue 5 bus 0101, 9050 Gent'
                        )
                    ),
                    new Municipality(
                        new PostInfoId(9050),
                        new MunicipalityName(
                            new MunicipalityNameId(44021),
                            new GeographicalName(
                                new LanguageCode('NL'),
                                'Gent'
                            )
                        )
                    ),
                    new StreetName(
                        new StreetNameId(69683),
                        new GeographicalName(
                            new LanguageCode('NL'),
                            'Bellevue'
                        )
                    ),
                    new Lambert72Point(105652.79, 192086.26)
                ),
                88.1244881244881
            ),
            new AddressMatch(
                new MunicipalityName(
                    new MunicipalityNameId(44021),
                    new GeographicalName(
                        new LanguageCode('NL'),
                        'Gent'
                    )
                ),
                new StreetName(
                    new StreetNameId(69683),
                    new GeographicalName(
                        new LanguageCode('NL'),
                        'Bellevue'
                    )
                ),
                new AddressDetail(
                    new Address(
                        new AddressId(5350009),
                        '5',
                        '0201',
                        $expected = new FullAddress(
                            new LanguageCode('NL'),
                            'Bellevue 5 bus 0201, 9050 Gent'
                        )
                    ),
                    new Municipality(
                        new PostInfoId(9050),
                        new MunicipalityName(
                            new MunicipalityNameId(44021),
                            new GeographicalName(
                                new LanguageCode('NL'),
                                'Gent'
                            )
                        )
                    ),
                    new StreetName(
                        new StreetNameId(69683),
                        new GeographicalName(
                            new LanguageCode('NL'),
                            'Bellevue'
                        )
                    ),
                    new Lambert72Point(105652.79, 192086.26)
                ),
                88.1244881244881
            ),
            new AddressMatch(
                new MunicipalityName(
                    new MunicipalityNameId(44021),
                    new GeographicalName(
                        new LanguageCode('NL'),
                        'Gent'
                    )
                ),
                new StreetName(
                    new StreetNameId(69683),
                    new GeographicalName(
                        new LanguageCode('NL'),
                        'Bellevue'
                    )
                ),
                new AddressDetail(
                    new Address(
                        new AddressId(5259525),
                        '5',
                        '0301',
                        $expected = new FullAddress(
                            new LanguageCode('NL'),
                            'Bellevue 5 bus 0301, 9050 Gent'
                        )
                    ),
                    new Municipality(
                        new PostInfoId(9050),
                        new MunicipalityName(
                            new MunicipalityNameId(44021),
                            new GeographicalName(
                                new LanguageCode('NL'),
                                'Gent'
                            )
                        )
                    ),
                    new StreetName(
                        new StreetNameId(69683),
                        new GeographicalName(
                            new LanguageCode('NL'),
                            'Bellevue'
                        )
                    ),
                    new Lambert72Point(105652.79, 192086.26)
                ),
                88.1244881244881
            ),
            new AddressMatch(
                new MunicipalityName(
                    new MunicipalityNameId(44021),
                    new GeographicalName(
                        new LanguageCode('NL'),
                        'Gent'
                    )
                ),
                new StreetName(
                    new StreetNameId(69683),
                    new GeographicalName(
                        new LanguageCode('NL'),
                        'Bellevue'
                    )
                ),
                new AddressDetail(
                    new Address(
                        new AddressId(5350010),
                        '5',
                        '0302',
                        $expected = new FullAddress(
                            new LanguageCode('NL'),
                            'Bellevue 5 bus 0302, 9050 Gent'
                        )
                    ),
                    new Municipality(
                        new PostInfoId(9050),
                        new MunicipalityName(
                            new MunicipalityNameId(44021),
                            new GeographicalName(
                                new LanguageCode('NL'),
                                'Gent'
                            )
                        )
                    ),
                    new StreetName(
                        new StreetNameId(69683),
                        new GeographicalName(
                            new LanguageCode('NL'),
                            'Bellevue'
                        )
                    ),
                    new Lambert72Point(105652.79, 192086.26)
                ),
                88.1244881244881
            ),
            new AddressMatch(
                new MunicipalityName(
                    new MunicipalityNameId(44021),
                    new GeographicalName(
                        new LanguageCode('NL'),
                        'Gent'
                    )
                ),
                new StreetName(
                    new StreetNameId(69683),
                    new GeographicalName(
                        new LanguageCode('NL'),
                        'Bellevue'
                    )
                ),
                new AddressDetail(
                    new Address(
                        new AddressId(5309355),
                        '5',
                        '0601',
                        $expected = new FullAddress(
                            new LanguageCode('NL'),
                            'Bellevue 5 bus 0601, 9050 Gent'
                        )
                    ),
                    new Municipality(
                        new PostInfoId(9050),
                        new MunicipalityName(
                            new MunicipalityNameId(44021),
                            new GeographicalName(
                                new LanguageCode('NL'),
                                'Gent'
                            )
                        )
                    ),
                    new StreetName(
                        new StreetNameId(69683),
                        new GeographicalName(
                            new LanguageCode('NL'),
                            'Bellevue'
                        )
                    ),
                    new Lambert72Point(105652.79, 192086.26)
                ),
                88.1244881244881
            ),
            new AddressMatch(
                new MunicipalityName(
                    new MunicipalityNameId(44021),
                    new GeographicalName(
                        new LanguageCode('NL'),
                        'Gent'
                    )
                ),
                new StreetName(
                    new StreetNameId(69683),
                    new GeographicalName(
                        new LanguageCode('NL'),
                        'Bellevue'
                    )
                ),
                new AddressDetail(
                    new Address(
                        new AddressId(5350011),
                        '5',
                        '0701',
                        $expected = new FullAddress(
                            new LanguageCode('NL'),
                            'Bellevue 5 bus 0701, 9050 Gent'
                        )
                    ),
                    new Municipality(
                        new PostInfoId(9050),
                        new MunicipalityName(
                            new MunicipalityNameId(44021),
                            new GeographicalName(
                                new LanguageCode('NL'),
                                'Gent'
                            )
                        )
                    ),
                    new StreetName(
                        new StreetNameId(69683),
                        new GeographicalName(
                            new LanguageCode('NL'),
                            'Bellevue'
                        )
                    ),
                    new Lambert72Point(105652.79, 192086.26)
                ),
                88.1244881244881
            ),
            new AddressMatch(
                new MunicipalityName(
                    new MunicipalityNameId(44021),
                    new GeographicalName(
                        new LanguageCode('NL'),
                        'Gent'
                    )
                ),
                new StreetName(
                    new StreetNameId(69683),
                    new GeographicalName(
                        new LanguageCode('NL'),
                        'Bellevue'
                    )
                ),
                new AddressDetail(
                    new Address(
                        new AddressId(5325904),
                        '5',
                        '0801',
                        $expected = new FullAddress(
                            new LanguageCode('NL'),
                            'Bellevue 5 bus 0801, 9050 Gent'
                        )
                    ),
                    new Municipality(
                        new PostInfoId(9050),
                        new MunicipalityName(
                            new MunicipalityNameId(44021),
                            new GeographicalName(
                                new LanguageCode('NL'),
                                'Gent'
                            )
                        )
                    ),
                    new StreetName(
                        new StreetNameId(69683),
                        new GeographicalName(
                            new LanguageCode('NL'),
                            'Bellevue'
                        )
                    ),
                    new Lambert72Point(105652.79, 192086.26)
                ),
                88.1244881244881
            ),
        );

        $normalizer = new AddressMatchesNormalizer();
        $jsonData = json_decode($this->json);

        $this->assertEquals(
            $expected,
            $normalizer->normalize($jsonData)
        );
    }
}
