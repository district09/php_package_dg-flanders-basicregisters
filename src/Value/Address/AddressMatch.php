<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Address;

use DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityName;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName;
use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * Result of an AddressMatch request.
 *
 * Addresses can be looked up using an AddressMatch request. Each found match
 * gets a score how close it matches the request.
 *
 * The address detail will only be in the returned data if the matching is done
 * with a house number. Without it it will only have the LocalityName and
 * StreetName values.
 */
final class AddressMatch extends ValueAbstract implements AddressMatchInterface
{

    /**
     * The locality name value.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityName
     */
    private $localityName;

    /**
     * The street name value.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName
     */
    private $streetName;

    /**
     * The address detail.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetailInterface|null
     */
    private $addressDetail;

    /**
     * The matching score.
     *
     * @var float
     */
    private $score;

    /**
     * Create a new address match object.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityName $localityName
     *   The locality name value.
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName $streetName
     *   The street name value.
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetailInterface|null $addressDetail
     *   The full address detail. This only if the match contains this data.
     * @param float $score
     */
    public function __construct(
        LocalityName $localityName,
        StreetName $streetName,
        ?AddressDetailInterface $addressDetail,
        float $score
    ) {
        $this->localityName = $localityName;
        $this->streetName = $streetName;
        $this->addressDetail = $addressDetail;
        $this->score = $score;
    }

    /**
     * @inheritDoc
     */
    public function localityName(): LocalityName
    {
        return $this->localityName;
    }

    /**
     * @inheritDoc
     */
    public function streetName(): StreetName
    {
        return $this->streetName;
    }

    /**
     * @inheritDoc
     */
    public function hasAddressDetail(): bool
    {
        return $this->addressDetail !== null;
    }


    /**
     * @inheritDoc
     */
    public function addressDetail(): ?AddressDetailInterface
    {
        return $this->addressDetail;
    }

    /**
     * @inheritDoc
     */
    public function score(): float
    {
        return $this->score;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object)
    {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatch $object */
        return $this->sameValueTypeAs($object)
            && $this->localityName()->sameValueAs($object->localityName())
            && $this->streetName()->sameValueAs($object->streetName())
            && $this->sameAddressDetailAs($object);
    }

    /**
     * Compare of other object has same addressDetails as this object.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatchInterface
     *
     * @return bool
     */
    private function sameAddressDetailAs(AddressMatchInterface $addressMatch): bool
    {
        if (!$this->hasAddressDetail()) {
            return !$addressMatch->hasAddressDetail();
        }

        return $addressMatch->hasAddressDetail()
          && $this->addressDetail()->sameValueAs($addressMatch->addressDetail());
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        return $this->hasAddressDetail()
            ? (string) $this->addressDetail()
            : sprintf('%s, %s', $this->streetName(), $this->localityName());
    }
}
