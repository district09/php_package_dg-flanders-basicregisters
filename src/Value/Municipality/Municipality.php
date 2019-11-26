<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Municipality;

use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId;
use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * A post info id + municipality.
 */
final class Municipality extends ValueAbstract
{
    /**
     * The post info id (postal code).
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId
     */
    private $postInfoId;

    /**
     * The municipality name.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName
     */
    private $municipalityName;

    /**
     * Create a new value.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId $postInfoId
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName $municipalityName
     */
    public function __construct(PostInfoId $postInfoId, MunicipalityName $municipalityName)
    {
        $this->postInfoId = $postInfoId;
        $this->municipalityName = $municipalityName;
    }

    /**
     * Get the post info id.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId
     */
    public function postInfoId(): PostInfoId
    {
        return $this->postInfoId;
    }

    /**
     * Get the postal code.
     *
     * @return int
     */
    public function postalCode(): int
    {
        return $this->postInfoId()->value();
    }

    /**
     * Get the municipality.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName
     */
    public function municipalityName(): MunicipalityName
    {
        return $this->municipalityName;
    }

    /**
     * Get the municipality name.
     *
     * @return string
     */
    public function name(): string
    {
        return $this->municipalityName()->name();
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\Municipality $object */
        return $this->sameValueTypeAs($object)
            && $this->postInfoId()->sameValueAs($object->postInfoId())
            && $this->municipalityName()->sameValueAs($object->municipalityName());
    }

    /**
     * @inheritDoc
     *
     * This will return "[postal code] [municipality name]".
     */
    public function __toString(): string
    {
        return sprintf('%d %s', $this->postalCode(), $this->name());
    }
}
