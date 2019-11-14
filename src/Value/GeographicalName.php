<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * The geographical name of an object.
 */
final class GeographicalName extends ValueAbstract
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
    public function sameValueAs(ValueInterface $object)
    {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName $object */
        return $this->sameValueTypeAs($object)
            && $this->languageCode()->sameValueAs($object->languageCode())
            && $this->spelling() === $object->spelling();
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        return $this->spelling();
    }
}
