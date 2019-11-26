<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Request;

use DigipolisGent\API\Client\Request\AbstractJsonRequest;
use DigipolisGent\Flanders\BasicRegisters\Uri\PostInfoDetailUri;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId;

/**
 * Request to get the details of a single post info item.
 */
final class PostInfoDetailRequest extends AbstractJsonRequest
{
    /**
     * Create a new post info detail request.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId $postInfoId
     */
    public function __construct(PostInfoId $postInfoId)
    {
        parent::__construct(
            new PostInfoDetailUri($postInfoId)
        );
    }
}
