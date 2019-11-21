<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters;

use DigipolisGent\Flanders\BasicRegisters\Service\AddressServiceInterface;
use DigipolisGent\Flanders\BasicRegisters\Service\MunicipalityNameServiceInterface;

/**
 * Container of all BasicRegister services.
 */
interface BasicRegisterInterface
{
    /**
     * Get the address(es) related service.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Service\AddressServiceInterface
     */
    public function address(): AddressServiceInterface;

    /**
     * Get the municipality name related service.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Service\MunicipalityNameServiceInterface
     */
    public function municipalityName(): MunicipalityNameServiceInterface;
}
