<?php

namespace Foo\Catalog\ORM;

use Bitrix\Main\Entity;
use Bitrix\Main\ORM\Fields\Field;
use Bitrix\Main\ORM\Fields\Relations\OneToMany;
use Bitrix\Main\SystemException;

/**
 * ORM simple Manufacturer entity
 */
final class ManufacturerTable extends DataManager
{
    private const FIELD_NAME_LENGTH_MIN = 2;
    private const FIELD_NAME_LENGTH_MAX = 128;

    /**
     * @return string
     */
    public static function getTableName(): string
    {
        return 'foo_manufacturer';
    }

    /**
     * @return string
     */
    public static function getUfId(): string
    {
        return 'FOO_MANUFACTURER';
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
                            'unique' => true,
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
                    (new OneToMany('MODELS', ModelTable::class, 'MANUFACTURER'))
                        ->configureJoinType('inner')
                ],
                parent::getMap()
            );
    }
}
