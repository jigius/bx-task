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

final class FooCatalogList extends CBitrixComponent
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
        if (!isset($this->arParams['GRID']) || !$this->arParams['GRID'] instanceof Catalog\App\GridInterface) {
            throw new InvalidArgumentException("`GRID` is not defined or its type is invalid");
        }
        $this->includeComponentTemplate();
    }
}
