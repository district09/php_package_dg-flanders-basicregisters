<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Pager;

/**
 * Interface to a pager that can be send along with the requests.
 */
interface PagerInterface
{
    /**
     * The current page of the pager.
     *
     * @return int
     */
    public function page(): int;

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

    /**
     * Return the pager info as query array.
     *
     * @return array
     */
    public function query(): array;
}
