<?php

/**
 *
 * Plain component. Is used for output items
 *
 */

use Bitrix\Main;
use Foo\Catalog;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    throw new LogicException("Environment is broken :(");
}

Main\Loader::includeModule('foo');
Main\UI\Extension::load("ui.bootstrap4");

final class FooCatalogBc extends CBitrixComponent
{
    /**
     * Cntr
     * @param $component
     */
    public function __construct($component = null)
    {
        parent::__construct($component);
    }

    /**
     * @inheritDoc
     */
    public function executeComponent(): void
    {
        $this->arResult["ITEMS"] = $this->arParams['ITEMS'] ?? [];
        $this->includeComponentTemplate();
    }
}
