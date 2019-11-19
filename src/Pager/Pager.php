<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Pager;

/**
 * Pager to send along with the requests.
 */
class Pager implements PagerInterface
{
    /**
     * The first record to return.
     *
     * @var int
     */
    private $offset;

    /**
     * The number of items per page.
     *
     * @var int
     */
    private $limit;

    /**
     * Create a new pager.
     *
     * @param int $offset
     * @param int $limit
     */
    public function __construct(int $offset = 0, int $limit = 20)
    {
        $this->offset = $offset;
        $this->limit = $limit;
    }

    /**
     * @inheritDoc
     */
    public function offset(): int
    {
        return $this->offset;
    }

    /**
     * @inheritDoc
     */
    public function limit(): int
    {
        return $this->limit;
    }
}
