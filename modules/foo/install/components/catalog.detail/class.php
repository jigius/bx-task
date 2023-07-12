<?php
/**
 *
 * Plain component. Is used for output items
 *
 */
use Bitrix\Main;
use Bitrix\Iblock;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    throw new LogicException("Environment is broken :(");
}

Main\Loader::includeModule('foo');

final class FooCatalogDetail extends CBitrixComponent
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
        if (!isset($this->arParams["ID"]) || !is_numeric($this->arParams["ID"])) {
            throw new InvalidArgumentException("`ID` is not defined or its type is invalid");
        }
        $product =
            (new ProductVanilla())
                ->withId((int)$this->arParams["ID"])
                ->loaded();

        //\Foo\Catalog\ORM\ProductTable::
        $this->includeComponentTemplate("foo");
    }
}
