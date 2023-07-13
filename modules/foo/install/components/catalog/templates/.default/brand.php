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

$APPLICATION
    ->IncludeComponent(
        "foo:catalog.list",
        ".default",
        [
            "SEF_MODE" => $arParams["SEF_MODE"] ?? "N",
            "SEF_FOLDER" => $arParams["SEF_FOLDER"] ?? ""
        ],
        $component,
        array("HIDE_ICONS" => "Y")
    );
