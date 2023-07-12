<?php

namespace Foo\Catalog\ORM;

use Bitrix\Main\Entity;
use Bitrix\Main\ORM\Fields\Field;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Join;
use Bitrix\Main\SystemException;

/**
 * ORM simple ProductOption entity
 */
final class ProductOptionTable extends DataManager
{
    /**
     * @return string
     */
    public static function getTableName(): string
    {
        return 'foo_product_option';
    }

    /**
     * @return string
     */
    public static function getUfId(): string
    {
        return 'FOO_PRODUCT_OPTION';
    }

    /**
     * @return array|Field[]
     * @throws SystemException
     */
    public static function getMap(): array
    {
        return
            array_merge(
                [
                    new Entity\IntegerField(
                        'ID',
                        [
                            'primary' => true,
                            'autocomplete' => true
                        ]
                    ),
                    new Entity\IntegerField('PRODUCT_ID'),
                    (new Reference(
                        'PRODUCT',
                        ProductTable::class,
                        Join::on('this.PRODUCT_ID', 'ref.ID')
                    ))
                        ->configureJoinType('inner'),
                    new Entity\IntegerField('OPTION_ID'),
                    (new Reference(
                        'OPTION',
                        OptionTable::class,
                        Join::on('this.OPTION_ID', 'ref.ID')
                    ))
                        ->configureJoinType('inner')
                ],
                parent::getMap()
            );
    }

    /**
     * @inheritDoc
     */
    public static function getEntityClass()
    {
        return ProductOptionEntity::class;
    }
}
