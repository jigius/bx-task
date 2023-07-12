<?php

namespace Foo\Catalog\ORM;

use Bitrix\Main;
use Bitrix\Main\Type\DateTime;

/**
 * Abstract class with an appended extra behaviour for using as the base for new orm classes in the project
 */
abstract class DataManager extends Main\Entity\DataManager
{
    protected const PARAM_CHANGE_BY_CLIENT_IS_PROHIBITED = "__client_prohibited";

    /**
     * @inheritDoc
     * @throws Main\SystemException
     */
    public static function getMap(): array
    {
        return [
            new Main\Entity\DatetimeField(
                'CREATED',
                [
                    'nullable' => false,
                    DataManager::PARAM_CHANGE_BY_CLIENT_IS_PROHIBITED => true
                ]
            ),
            new Main\Entity\DatetimeField(
                'MODIFIED',
                [
                    'nullable' => false,
                    DataManager::PARAM_CHANGE_BY_CLIENT_IS_PROHIBITED => true
                ]
            )
        ];
    }

    /**
     * @param Main\Entity\Event $event
     * @return Main\Entity\EventResult
     */
    public static function onBeforeAdd(Main\Entity\Event $event): Main\Entity\EventResult
    {
        return self::preparedEventResult($event, true);
    }

    /**
     * @param Main\Entity\Event $event
     * @return Main\Entity\EventResult
     */
    public static function onBeforeUpdate(Main\Entity\Event $event): Main\Entity\EventResult
    {
        return self::preparedEventResult($event);
    }

    /**
     * 1. Prohibits to the client changing fields with have the appropriate property
     * 2. Defines values for "system" fields
     *
     * @param Main\Entity\Event $event
     * @param bool $new
     * @return Main\Entity\EventResult
     */
    private static function preparedEventResult(Main\Entity\Event $event, bool $new = false): Main\Entity\EventResult
    {
        $er = new Main\Entity\EventResult();
        $fields = $event->getEntity()->getFields();
        foreach ($fields as $f) {
            if ($f->getParameter(DataManager::PARAM_CHANGE_BY_CLIENT_IS_PROHIBITED) ?? false) {
                $er->unsetField($f->getName());
            }
        }
        $now = new DateTime();
        $modFields = ['MODIFIED' => $now];
        if ($new) {
            $modFields['CREATED'] = $now;
        }
        $er->modifyFields($modFields);
        return $er;
    }
}
