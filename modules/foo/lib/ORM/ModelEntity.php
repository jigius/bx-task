<?php

namespace Foo\Catalog\ORM;

use Bitrix\Main\ORM as Base;

/**
 * Extends base class for the appending additional statements for db scheme changing
 */
final class ModelEntity extends Base\Entity
{
    /**
     * @inheritDoc
     */
    public function compileDbTableStructureDump(): array
    {
        return
            array_merge(
                parent::compileDbTableStructureDump(),
                [
                    "CREATE INDEX `MANUFACTURER_ID` ON `" . self::getDBTableName() . "` (`MANUFACTURER_ID`)"
                ]
            );
    }
}
