<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;
use Webmozart\Assert\Assert;

/**
 * The language code of an object or property.
 */
final class LanguageCode extends ValueAbstract
{
    /**
     * The language code.
     *
     * @var string
     */
    private $code;

    /**
     * Create the language object from the language code.
     *
     * @param string $code
     */
    public function __construct(string $code)
    {
        Assert::length($code, 2);

        $this->code = strtoupper($code);
    }

    /**
     * Get the language code.
     *
     * @return string
     */
    public function code(): string
    {
        return $this->code;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode $object */
        return $this->sameValueTypeAs($object)
            && $this->code() === $object->code();
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->code();
    }
}
