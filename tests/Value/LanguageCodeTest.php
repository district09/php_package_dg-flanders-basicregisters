<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value;

use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode
 */
class LanguageCodeTest extends TestCase
{

    /**
     * Exception is thrown when code length ≠ 2.
     *
     * @param string $code
     *   The code to test.
     * @param bool $expectException
     *   Should the code trigger an exception.
     *
     * @dataProvider codeStringLengthProvider
     *
     * @test
     */
    public function codeStringLengthShouldBeTwo(string $code, bool $expectException): void
    {
        if ($expectException) {
            $this->expectException(InvalidArgumentException::class);
        }

        new LanguageCode($code);
        $this->assertFalse($expectException, 'Code dit not trigger an exception.');
    }

    /**
     * Data provider to test the character length assertion.
     *
     * @return array
     *   Each record in the array contains:
     *   - string : The code to test.
     *   - bool : Should the code trigger an exception.
     */
    public function codeStringLengthProvider(): array
    {
        return [
            ['', true],
            ['A', true],
            ['AB', false],
            ['ABC', true],
        ];
    }

    /**
     * Code is transformed to uppercase.
     *
     * @test
     */
    public function codeIsTransformedToUppercase(): void
    {
        $languageCode = new LanguageCode('ab');
        $this->assertSame('AB', $languageCode->code());
    }

    /**
     * Not the same values if the codes are not the same.
     *
     * @test
     */
    public function notTheSameIfCodesAreDifferent(): void
    {
        $languageCode = new LanguageCode('AB');
        $otherLanguageCode = new LanguageCode('CD');
        $this->assertFalse($languageCode->sameValueAs($otherLanguageCode));
    }

    /**
     * Same value if the share the same id value.
     *
     * @test
     */
    public function sameValueIfCodesAreTheSame(): void
    {
        $languageCode = new LanguageCode('AB');
        $sameLanguageCode = new LanguageCode('AB');
        $this->assertTrue($languageCode->sameValueAs($sameLanguageCode));
    }

    /**
     * Id is returned as string.
     *
     * @test
     */
    public function castToStringReturnsCode(): void
    {
        $languageCode = new LanguageCode('AB');
        $this->assertSame('AB', (string) $languageCode);
    }
}
