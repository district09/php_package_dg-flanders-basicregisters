<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Pager;

/**
 * Interface to a pager that can be send along with the requests.
 */
interface PagerInterface
{
    /**
     * Get the pager offset.
     *
     * @return int
     */
    public function offset(): int;

    /**
     * Get the number of items per page.
     *
     * @return int
     */
    public function limit(): int;
}
