<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * Result of an AddressMatch request.
 *
 * Addresses can be looked up using an AddressMatch request. Each found match
 * gets a score how close it matches the request.
 */
final class AddressMatch extends ValueAbstract implements AddressMatchInterface
{
    /**
     * The address detail.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\AddressDetailInterface
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
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\AddressDetailInterface $addressDetail
     * @param float $score
     */
    public function __construct(AddressDetailInterface $addressDetail, float $score)
    {
        $this->addressDetail = $addressDetail;
        $this->score = $score;
    }

    /**
     * @inheritDoc
     */
    public function addressId(): AddressId
    {
        return $this->addressDetail()->addressId();
    }

    /**
     * @inheritDoc
     */
    public function addressDetail(): AddressDetailInterface
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
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\AddressMatch $object */
        return $this->sameValueTypeAs($object)
            && $this->addressDetail()->sameValueAs($object->addressDetail());
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        return (string) $this->addressDetail();
    }
}
