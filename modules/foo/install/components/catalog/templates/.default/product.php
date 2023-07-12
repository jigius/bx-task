<?php
/**
 * @var CMain $APPLICATION
 * @var CUser $user
 * @var Bitrix\Main\DB\Connection $DB
 * @var CBitrixComponentTemplate $this
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 * @var array $arLangMessages
 * @var string $templateFolder
 * @var string $templateName
 * @var string $componentPath
 * @var string $parentTemplateFolder
 * @var array $templateData
 */

use Foo\Catalog;

if (
    !isset($arResult["VARIABLES"]["BRAND"]) ||
    !is_numeric($arResult["VARIABLES"]["BRAND"]) ||
    !isset($arResult["VARIABLES"]["MODEL"]) ||
    !is_numeric($arResult["VARIABLES"]["MODEL"])
) {
    throw new InvalidArgumentException("could not fetch data about product");
}

$APPLICATION
    ->IncludeComponent(
        "foo:catalog.list",
        ".default",
        [
            "GRID" =>
                (new Catalog\App\GridVanilla(
                    new Catalog\App\FilterVanilla(),
                    new Catalog\App\PaginationVanilla(),
                    new Catalog\App\UrnItemProduct(
                        (new Catalog\App\URN\UrnVanilla($arParams["SEF_MODE"] === "Y"))
                            ->withBasePath($arParams["SEF_FOLDER"] ?? $APPLICATION->GetCurDir())
                            ->withManufacturer((int)$arResult["VARIABLES"]["BRAND"])
                            ->withModel((int)$arResult["VARIABLES"]["MODEL"])
                    )
                ))
                    ->withId("prod")
                    ->withQuery(
                        Catalog\ORM\ProductTable::query()
                            ->where("MODEL_ID", "=", (int)$arResult["VARIABLES"]["MODEL"])
                    )
                    ->withColumn("ISSUED", GetMessage("FOO_CATALOG_GRID_LBL_FISSUED"))
                    ->withColumn("PRICE", GetMessage("FOO_CATALOG_GRID_LBL_FPRICE")),
            "LIST_HEADER_LBL" => GetMessage("FOO_CATALOG_LIST_HEADER")
        ],
        $component,
        array("HIDE_ICONS" => "Y")
    );
