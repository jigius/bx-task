<?php

use Bitrix\Main;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    throw new LogicException("Environment is broken :(");
}

Main\Loader::includeModule('iblock');

$arComponentParameters = [
    "PARAMETERS" => [
        "VARIABLE_ALIASES" => [
            "MODEL" => [
                "NAME" => GetMessage("FOO_CATALOG_VA_MODEL"),
            ],
            "BRAND" => [
                "NAME" => GetMessage("FOO_CATALOG_VA_BRAND"),
            ],
            "DETAIL" => [
                "NAME" => GetMessage("FOO_CATALOG_VA_DETAIL")
            ],
        ],
        "SEF_MODE" => [
            "detail" => [
                "NAME" => GetMessage("FOO_CATALOG_SEF_DETAIL"),
                "DEFAULT" => "detail/#DETAIL#/",
                "VARIABLES" => []
            ],
            "brand" => [
                "NAME" => GetMessage("FOO_CATALOG_SEF_BRAND"),
                "DEFAULT" => "",
                "VARIABLES" => [],
            ],
            "model" => [
                "NAME" => GetMessage("FOO_CATALOG_SEF_MODEL"),
                "DEFAULT" => "#BRAND#/",
                "VARIABLES" => [
                    "BRAND"
                ],
            ],
            "product" => [
                "NAME" => GetMessage("FOO_CATALOG_SEF_PRODUCT"),
                "DEFAULT" => "#BRAND#/#MODEL#/",
                "VARIABLES" => [
                    "BRAND",
                    "MODEL"
                ],
            ],
        ]
    ]
];
CIBlockParameters::Add404Settings($arComponentParameters, []);
