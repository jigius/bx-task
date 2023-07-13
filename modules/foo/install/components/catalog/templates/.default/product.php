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

if (
    !isset($arResult["VARIABLES"]["BRAND"]) ||
    !is_numeric($arResult["VARIABLES"]["BRAND"]) ||
    (int)$arResult["VARIABLES"]["BRAND"] <= 0 ||
    !isset($arResult["VARIABLES"]["MODEL"]) ||
    !is_numeric($arResult["VARIABLES"]["MODEL"]) ||
    (int)$arResult["VARIABLES"]["MODEL"] <= 0
) {
    throw new InvalidArgumentException("could not fetch data about product");
}

$APPLICATION
    ->IncludeComponent(
        "foo:catalog.list",
        ".default",
        [
            "BRAND_ID" => (int)$arResult["VARIABLES"]["BRAND"],
            "MODEL_ID" => (int)$arResult["VARIABLES"]["MODEL"],
            "SEF_MODE" => $arParams["SEF_MODE"] ?? "N",
            "SEF_FOLDER" => $arParams["SEF_FOLDER"] ?? ""
        ],
        $component,
        array("HIDE_ICONS" => "Y")
    );
