<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Geographical;

use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Value\CollectionAbstract;
use Webmozart\Assert\Assert;

/**
 * Collection of geographical names.
 */
abstract class AbstractGeographicalNames extends CollectionAbstract
{

    /**
     * Create the collection from one or more geographical names.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName ...$geoGraphicalNames
     */
    public function __construct(...$geoGraphicalNames)
    {
        Assert::notEmpty($geoGraphicalNames);

        foreach ($geoGraphicalNames as $geographicalName) {
            $this->values[$geographicalName->languageCode()->code()] = $geographicalName;
        }
    }

    /**
     * Get the spelling for a specific language code.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode $languageCode
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName|null
     *   The geographical name (if any).
     */
    public function translation(LanguageCode $languageCode): ?GeographicalName
    {
        return $this->values[$languageCode->code()] ?? null;
    }

    /**
     * Get the translated name.
     *
     * This will return:
     * - Return the translation if available.
     * - Fall back to dutch translation if available.
     * - Fall back to first translation if no other is available.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode $languageCode
     *
     * @return string
     */
    public function translatedName(LanguageCode $languageCode): string
    {
        $items = [
            $this->translation($languageCode),
            $this->translation(new LanguageCode('NL')),
            reset($this->values)
        ];
        $itemsFiltered = array_filter($items);

        return reset($itemsFiltered)->spelling();
    }

    /**
     * Get the default name from the collection.
     *
     * This will always try to return the dutch (NL) spelling of the collection.
     * If NL is not available, it will return the first spelling.
     */
    public function name(): string
    {
        return $this->translatedName(new LanguageCode('NL'));
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        return $this->name();
    }
}
