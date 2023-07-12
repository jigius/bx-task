<?php

namespace Foo\Catalog\ORM;

use Foo\Catalog as L;

/**
 * Defines the instance for the iteration with the configured in project orm-entities
 */
final class ConfiguredEntities implements IterableEntitiesInterface
{
    /**
     * Cntr
     */
    public function __construct()
    {
    }

    /**
     * @inheritDoc
     */
    public function each(callable $callee): void
    {
        $usedEntities = [
            L\ORM\ManufacturerTable::getEntity(),
            L\ORM\ModelTable::getEntity(),
            L\ORM\ProductTable::getEntity(),
            L\ORM\OptionTable::getEntity(),
            L\ORM\ProductOptionTable::getEntity()
        ];
        foreach ($usedEntities as $entity) {
            if (call_user_func($callee, $entity) === false) {
                break;
            }
        }
    }
}
