<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson;

/**
 * Extracts the object id from given JSON data into an integer.
 */
final class IdExtractor
{
    /**
     * Extract the ID value from the json object data into an integer.
     *
     * Its supports:
     * - ID stored in the objectId property.
     * - ID stored in the identificator->objectId property.
     *
     * @param object $jsonData
     *
     * @return int
     */
    public function extractObjectId(object $jsonData): int
    {
        $objectId = $jsonData->identificator->objectId ?? $jsonData->objectId;
        return (int) $objectId;
    }
}
