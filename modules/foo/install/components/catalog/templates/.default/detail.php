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
    !isset($arResult["VARIABLES"]["DETAIL"]) ||
    !is_numeric($arResult["VARIABLES"]["DETAIL"])
) {
    throw new InvalidArgumentException("could not fetch data about detail");
}
$APPLICATION
    ->IncludeComponent(
        "foo:catalog.detail",
        ".default",
        [
            "ID" => (int)$arResult["VARIABLES"]["DETAIL"],
            "SEF_MODE" => $arParams["SEF_MODE"] ?? "N",
            "SEF_FOLDER" => $arParams["SEF_FOLDER"] ?? ""
        ],
        $component,
        array("HIDE_ICONS" => "Y")
    );
