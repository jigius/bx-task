<?php

namespace Foo\Catalog\ORM;

use Bitrix\Main\ORM as Base;

/**
 * Extends base class for the appending additional statements for db scheme changing
 */
final class ProductOptionEntity extends Base\Entity
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
                    "CREATE INDEX `PRODUCT_OPTION` ON `" . self::getDBTableName() . "` (`PRODUCT_ID`, `OPTION_ID`)",
                    "CREATE INDEX `OPTION_ID` ON `" . self::getDBTableName() . "` (`OPTION_ID`)"
                ]
            );
    }
}
