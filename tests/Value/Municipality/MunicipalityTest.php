<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value\Municipality;

use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\Municipality;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\Municipality
 */
class MunicipalityTest extends TestCase
{

    /**
     * Municipality is created from its details.
     *
     * @test
     */
    public function valueIsCreatedFromItsDetails(): void
    {
        $postInfoId = new PostInfoId(9000);
        $municipalityName = $this->createMunicipalityName(100, 'Gent');

        $municipality = new Municipality($postInfoId, $municipalityName);

        $this->assertSame($postInfoId, $municipality->postInfoId());
        $this->assertSame($municipalityName, $municipality->municipalityName());
    }

    /**
     * Postal code is extracted from the postInfoId.
     *
     * @test
     */
    public function postalCodeIsExtractedFromPostInfoId(): void
    {
        $postInfoId = new PostInfoId(9000);
        $municipalityName = $this->createMunicipalityName(100, 'Gent');

        $municipality = new Municipality($postInfoId, $municipalityName);

        $this->assertSame($postInfoId->value(), $municipality->postalCode());
    }

    /**
     * Not the same value if the post info ids are different.
     *
     * @test
     */
    public function notSameIfPostInfoIdsAreDifferent(): void
    {
        $postInfoId = new PostInfoId(9000);
        $municipalityName = $this->createMunicipalityName(100, 'Gent');

        $municipality = new Municipality($postInfoId, $municipalityName);

        $otherMunicipality = new Municipality(
            new PostInfoId(9123),
            $municipalityName
        );

        $this->assertFalse($municipality->sameValueAs($otherMunicipality));
    }

    /**
     * Not the same value if the municipality name is different.
     *
     * @test
     */
    public function notSameIfMunicipalityNameIsDifferent(): void
    {
        $postInfoId = new PostInfoId(9000);
        $municipalityName = $this->createMunicipalityName(100, 'Gent');

        $municipality = new Municipality($postInfoId, $municipalityName);
        $otherMunicipality = new Municipality(
            $postInfoId,
            $this->createMunicipalityName(200, 'Foo')
        );

        $this->assertFalse($municipality->sameValueAs($otherMunicipality));
    }

    /**
     * Same values if all details are identical.
     *
     * @test
     */
    public function sameIfAllDetailsAreIdentical(): void
    {
        $postInfoId = new PostInfoId(9000);
        $municipalityName = $this->createMunicipalityName(100, 'Gent');

        $municipality = new Municipality($postInfoId, $municipalityName);
        $sameMunicipality = new Municipality($postInfoId, $municipalityName);

        $this->assertTrue($municipality->sameValueAs($sameMunicipality));
    }

    /**
     * Casting to string returns "[postal code] [municipality name]".
     *
     * @test
     */
    public function castToStringReturnsPostalCodeAndName(): void
    {
        $municipality = new Municipality(
            new PostInfoId(9000),
            $this->createMunicipalityName(100, 'Gent')
        );

        $this->assertSame('9000 Gent', (string) $municipality);
    }

    /**
     * Create a municipality name value.
     *
     * @param int $identifier
     * @param string $name
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName
     */
    private function createMunicipalityName(int $identifier, string $name): MunicipalityName
    {
        return new MunicipalityName(
            new MunicipalityNameId($identifier),
            new GeographicalName(
                new LanguageCode('NL'),
                $name
            )
        );
    }
}
