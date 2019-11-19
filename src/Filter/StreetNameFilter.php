<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Filter;

/**
 * Filter the query by the street name.
 */
final class StreetNameFilter extends AbstractFilter
{
    /**
     * @inheritDoc
     */
    public function name(): string
    {
        return 'straatnaam';
    }
}
