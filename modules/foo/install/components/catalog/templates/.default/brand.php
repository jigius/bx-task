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

$APPLICATION
    ->IncludeComponent(
        "foo:catalog.list",
        ".default",
        [
            "GRID" =>
                (new Catalog\App\GridVanilla(
                    new Catalog\App\FilterVanilla(),
                    new Catalog\App\PaginationVanilla(),
                    new Catalog\App\UrnItemManufacturer(
                        (new Catalog\App\URN\UrnVanilla($arParams["SEF_MODE"] === "Y"))
                            ->withBasePath($arParams["SEF_FOLDER"] ?? $APPLICATION->GetCurDir())
                    )
                ))
                    ->withId("brand")
                    ->withQuery(Catalog\ORM\ManufacturerTable::query()),
            "LIST_HEADER_LBL" => GetMessage("FOO_CATALOG_LIST_HEADER")
        ],
        $component,
        array("HIDE_ICONS" => "Y")
    );
