<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Post;

use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\WithGeographicalNamesInterface;
use DigipolisGent\Value\ValueInterface;

/**
 * Post info value.
 */
interface PostInfoInterface extends ValueInterface, WithGeographicalNamesInterface
{
    /**
     * Get the post info id.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId
     */
    public function postInfoId(): PostInfoId;

    /**
     * Get the postal code.
     *
     * @return int
     */
    public function postalCode(): int;
}
