<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Filter;

/**
 * Filter by National Statistics Institute municipality code.
 */
final class MunicipalityNisCodeFilter extends AbstractFilter
{
    /**
     * @inheritDoc
     */
    public function name(): string
    {
        return 'niscode';
    }
}
