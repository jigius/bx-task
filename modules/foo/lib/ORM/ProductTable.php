<?php

namespace Foo\Catalog\ORM;

use Bitrix\Main\Entity;
use Bitrix\Main\ORM\Fields\Field;
use Bitrix\Main\ORM\Fields\Relations\OneToMany;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Join;
use Bitrix\Main\SystemException;

/**
 * ORM simple Product entity
 */
final class ProductTable extends DataManager
{
    private const FIELD_NAME_LENGTH_MIN = 2;
    private const FIELD_NAME_LENGTH_MAX = 255;
    private const FIELD_YEAR_MIN_VALUE = 1900;
    private const FIELD_YEAR_MAX_VALUE = 2100;
    private const FIELD_PRICE_MIN_VALUE = 1;
    private const FIELD_PRICE_MAX_VALUE = 10000000;

    /**
     * @return string
     */
    public static function getTableName(): string
    {
        return 'foo_product';
    }

    /**
     * @return string
     */
    public static function getUfId(): string
    {
        return 'FOO_PRODUCT';
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
                    new Entity\StringField(
                        'NAME',
                        [
                            'required' => true,
                            'size' => self::FIELD_NAME_LENGTH_MAX,
                            'save_data_modification' => function () {
                                return [
                                    function (string $value): string {
                                        return trim($value);
                                    }
                                ];
                            },
                            'validation' => function () {
                                return [
                                    new Entity\Validator\Length(
                                        self::FIELD_NAME_LENGTH_MIN,
                                        self::FIELD_NAME_LENGTH_MAX
                                    )
                                ];
                            }
                        ]
                    ),
                    new Entity\IntegerField(
                        'ISSUED',
                        [
                            'required' => true,
                            'validation' => function () {
                                return [
                                    new Entity\Validator\Range(
                                        self::FIELD_YEAR_MIN_VALUE,
                                        self::FIELD_YEAR_MAX_VALUE
                                    )
                                ];
                            }
                        ]
                    ),
                    new Entity\IntegerField(
                        'PRICE',
                        [
                            'required' => true,
                            'validation' => function () {
                                return [
                                    new Entity\Validator\Range(
                                        self::FIELD_PRICE_MIN_VALUE,
                                        self::FIELD_PRICE_MAX_VALUE
                                    )
                                ];
                            }
                        ]
                    ),
                    new Entity\IntegerField('MODEL_ID'),
                    (new Reference(
                        'MODEL',
                        ModelTable::class,
                        Join::on('this.MODEL_ID', 'ref.ID')
                    ))
                        ->configureJoinType('inner'),
                    (new OneToMany('PRODUCTS_OPTIONS', ProductOptionTable::class, 'PRODUCT'))
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
        return ProductEntity::class;
    }
}
