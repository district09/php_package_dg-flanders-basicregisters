<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Filter;

/**
 * Filter the request by house number.
 */
final class HouseNumberFilter extends AbstractFilter
{
    /**
     * @inheritDoc
     */
    public function name(): string
    {
        return 'huisnummer';
    }
}
