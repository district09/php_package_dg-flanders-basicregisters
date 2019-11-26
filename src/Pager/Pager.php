<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Pager;

/**
 * Pager to send along with the requests.
 */
class Pager implements PagerInterface
{
    /**
     * The page the pager is currently on.
     *
     * @var int
     */
    private $page;

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
     * @param int $page
     * @param int $limit
     */
    public function __construct(int $page = 0, int $limit = 20)
    {
        $this->page = $page;
        $this->offset = $page * $limit;
        $this->limit = $limit;
    }

    /**
     * @inheritDoc
     */
    public function page(): int
    {
        return $this->page;
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

    /**
     * @inheritDoc
     */
    public function query(): array
    {
        return [
            'offset' => $this->offset(),
            'limit' => $this->limit(),
        ];
    }
}
