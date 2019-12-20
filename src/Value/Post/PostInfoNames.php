<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Post;

use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Value\CollectionAbstract;

/**
 * Collection of post info names.
 *
 * This collection does not behave the same as the GeographicalNames collection:
 * The service returns a list of (sub)municipality names if they share the same
 * PostInfoId (postal code). All names are in dutch (NL).
 */
class PostInfoNames extends CollectionAbstract
{
    /**
     * The "main" name from the collection.
     *
     * This is by default the one written in ALL CAPS.
     * If no ALL caps is available, this will be the first of the collection.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName
     */
    private $mainName;

    /**
     * Create a collection from the given names.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName ...$geographicalNames
     */
    public function __construct(GeographicalName ...$geographicalNames)
    {
        $this->values = $geographicalNames;
        $this->detectMainName();
    }

    /**
     * Get the main name from the collection.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName
     */
    public function geographicalName(): GeographicalName
    {
        return $this->mainName;
    }

    /**
     * Get the main name as string.
     *
     * @return string
     */
    public function name(): string
    {
        return $this->geographicalName()->spelling();
    }

    /**
     * Get all the names as array of string.
     *
     * The main name will be the first in the list.
     *
     * @return string[]
     */
    public function names(): array
    {
        $names = [$this->name()];
        foreach ($this->values as $value) {
            if ($value->sameValueAs($this->geographicalName())) {
                continue;
            }

            $names[] = $value->spelling();
        }

        return $names;
    }

    /**
     * Has the names collection submunicipality names.
     *
     * This will be true if there are more then 1 name in the collection.
     *
     * @return bool
     */
    public function hasSubMunicipalities(): bool
    {
        return count($this->values) > 1;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->name();
    }

    /**
     * Detect the main name from the collection.
     *
     * The main name is:
     * - The name written in all caps.
     * - If no all caps name, the first one from the collection.
     *
     * If the main name is found:
     * - The value is replaced by a Capitalized version of the name.
     */
    private function detectMainName(): void
    {
        foreach ($this->values as $key => $geographicalName) {
            /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName $geographicalName */
            if (preg_match('/[a-z]/', $geographicalName->spelling())) {
                continue;
            }

            $name = new GeographicalName(
                $geographicalName->languageCode(),
                ucwords(strtolower($geographicalName->spelling()), '-')
            );

            $this->mainName = $name;
            $this->values[$key] = $name;
            return;
        }

        $this->mainName = reset($this->values);
    }
}
