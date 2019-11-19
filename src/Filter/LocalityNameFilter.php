<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Filter;

/**
 * Filter the query by locality name.
 */
final class LocalityNameFilter extends AbstractFilter
{
    /**
     * @inheritDoc
     */
    public function name(): string
    {
        return 'gemeentenaam';
    }
}
