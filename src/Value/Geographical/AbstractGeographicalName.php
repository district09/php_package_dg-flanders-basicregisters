<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Geographical;

use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * Abstract geographical name of an object.
 */
abstract class AbstractGeographicalName extends ValueAbstract
{
    /**
     * The language code.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode
     */
    private $languageCode;

    /**
     * The spelling of the name.
     *
     * @var string
     */
    private $spelling;

    /**
     * Create the geographical name from language code and spelling.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode $languageCode
     * @param string $spelling
     */
    public function __construct(LanguageCode $languageCode, string $spelling)
    {
        $this->languageCode = $languageCode;
        $this->spelling = $spelling;
    }

    /**
     * Get the language code.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode
     */
    public function languageCode(): LanguageCode
    {
        return $this->languageCode;
    }

    /**
     * Get the spelling.
     *
     * @return string
     */
    public function spelling(): string
    {
        return $this->spelling;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName $object */
        return $this->sameValueTypeAs($object)
            && $this->languageCode()->sameValueAs($object->languageCode())
            && $this->spelling() === $object->spelling();
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->spelling();
    }
}
