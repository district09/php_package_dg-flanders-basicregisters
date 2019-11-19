<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Filter;

/**
 * Interface to create a request filter.
 */
interface FilterInterface
{
    /**
     * Get the filter argument name.
     *
     * @return string
     */
    public function name(): string;

    /**
     * Get the filter value.
     *
     * @return string|int|float
     */
    public function value();
}
