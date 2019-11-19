<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Request;

use DigipolisGent\API\Client\Request\AbstractRequest;
use DigipolisGent\Flanders\BasicRegisters\Uri\AddressesUri;

/**
 * Request to get a list of addresses.
 */
final class AddressListRequest extends AbstractRequest
{

    /**
     * @inheritDoc
     */
    public function __construct()
    {
        parent::__construct(new AddressesUri());
    }
}
