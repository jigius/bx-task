<?php

/**
 *
 * Plain component. Is used for output product
 *
 */

use Bitrix\Main;
use Foo\Catalog;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    throw new LogicException("Environment is broken :(");
}

Main\Loader::includeModule('foo');
Main\UI\Extension::load("ui.bootstrap4");
IncludeModuleLangFile(__FILE__);

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
        if (
            !isset($this->arParams["ID"]) ||
            !is_numeric($this->arParams["ID"]) ||
            (int)$this->arParams["ID"] <= 0
        ) {
            throw new InvalidArgumentException("`ID` is not defined or its type is invalid");
        }
        $product =
            Foo\Catalog\ORM\ProductTable::getByPrimary(
                (int)$this->arParams["ID"],
                [
                    "select" => ["*", "MODEL", "PRODUCTS_OPTIONS"]
                ]
            )
                ->fetchObject();
        if ($product === null) {
            throw new RuntimeException("not found", 404);
        }
        if (!$product instanceof Catalog\ORM\EO_Product) {
            throw new LogicException("type invalid");
        }
        $urn =
            (new Catalog\App\URN\UrnVanilla(
                isset($this->arParams["SEF_MODE"]) && $this->arParams["SEF_MODE"] === "Y"
            ))
                ->withBasePath(
                    !empty($this->arParams["SEF_FOLDER"]) ?
                        $this->arParams["SEF_FOLDER"] :
                        GetDirPath(GetPagePath())
                );
        $model = $product->getModel();
        $model->fill(["MANUFACTURER"]);
        $this->arResult["PRODUCT"] = $product;
        $this->arResult["MODEL"] = $model;
        $this->arResult["MODEL_URN"] = $urn->withManufacturer($model->getManufacturerId())->withModel($model->getId());
        $this->arResult["MANUFACTURER"] = $model->getManufacturer();
        $this->arResult["MANUFACTURER_URN"] = $urn->withManufacturer($model->getManufacturerId());
        $this->arResult["OPTIONS"] =
            array_map(
                function (Catalog\ORM\EO_ProductOption $po): Catalog\ORM\EO_Option {
                    return $po->getOption();
                },
                (function ($productOptions): array {
                    $productOptions->fill("OPTION");
                    return iterator_to_array($productOptions);
                })($product->getProductsOptions())
            );
        $this->arResult["BREADCRUMBS"] =
            (new Catalog\App\BreadcrumbsVanilla())
                ->withItem(GetMessage("FOO_CATALOG_DETAIL_BC_MANUFACTURER_ALL"), $urn->urn())
                ->withItem($this->arResult["MANUFACTURER"]->getName(), $this->arResult["MANUFACTURER_URN"]->urn())
                ->withItem($this->arResult["MODEL"]->getName(), $this->arResult["MODEL_URN"]->urn())
                ->withItem($this->arResult["PRODUCT"]->getName(), "");
        $this->includeComponentTemplate();
    }
}
