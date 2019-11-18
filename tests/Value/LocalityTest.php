<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value;

use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\LocalityName;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality;
use DigipolisGent\Flanders\BasicRegisters\Value\LocalityNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\PostInfoId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\Locality
 */
class LocalityTest extends TestCase
{

    /**
     * Locality is created from its details.
     *
     * @test
     */
    public function valueIsCreatedFromItsDetails(): void
    {
        $postInfoId = new PostInfoId(9000);
        $localityName = $this->createLocalityName(100, 'Gent');

        $locality = new Locality($postInfoId, $localityName);

        $this->assertSame($postInfoId, $locality->postInfoId());
        $this->assertSame($localityName, $locality->localityName());
    }

    /**
     * Postal code is extracted from the postInfoId.
     *
     * @test
     */
    public function postalCodeIsExtractedFromPostInfoId(): void
    {
        $postInfoId = new PostInfoId(9000);
        $localityName = $this->createLocalityName(100, 'Gent');

        $locality = new Locality($postInfoId, $localityName);

        $this->assertSame($postInfoId->value(), $locality->postalCode());
    }

    /**
     * Not the same value if the post info ids are different.
     *
     * @test
     */
    public function notSameIfPostInfoIdsAreDifferent(): void
    {
        $postInfoId = new PostInfoId(9000);
        $localityName = $this->createLocalityName(100, 'Gent');

        $locality = new Locality($postInfoId, $localityName);

        $otherLocality = new Locality(
            new PostInfoId(9123),
            $localityName
        );

        $this->assertFalse($locality->sameValueAs($otherLocality));
    }

    /**
     * Not the same value if the locality name is different.
     *
     * @test
     */
    public function notSameIfLocalityNameIsDifferent(): void
    {
        $postInfoId = new PostInfoId(9000);
        $localityName = $this->createLocalityName(100, 'Gent');

        $locality = new Locality($postInfoId, $localityName);
        $otherLocality = new Locality(
            $postInfoId,
            $this->createLocalityName(200, 'Foo')
        );

        $this->assertFalse($locality->sameValueAs($otherLocality));
    }

    /**
     * Same values if all details are identical.
     *
     * @test
     */
    public function sameIfAllDetailsAreIdentical(): void
    {
        $postInfoId = new PostInfoId(9000);
        $localityName = $this->createLocalityName(100, 'Gent');

        $locality = new Locality($postInfoId, $localityName);
        $sameLocality = new Locality($postInfoId, $localityName);

        $this->assertTrue($locality->sameValueAs($sameLocality));
    }

    /**
     * Casting to string returns "[postal code] [locality name]".
     *
     * @test
     */
    public function castToStringReturnsPostalCodeAndName(): void
    {
        $locality = new Locality(
            new PostInfoId(9000),
            $this->createLocalityName(100, 'Gent')
        );

        $this->assertSame('9000 Gent', (string) $locality);
    }

    /**
     * Create a locality name value.
     *
     * @param int $identifier
     * @param string $name
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\LocalityName
     */
    private function createLocalityName(int $identifier, string $name): LocalityName
    {
        return new LocalityName(
            new LocalityNameId($identifier),
            new GeographicalName(
                new LanguageCode('NL'),
                $name
            )
        );
    }
}
