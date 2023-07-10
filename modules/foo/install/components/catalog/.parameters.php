<?php

use Bitrix\Main\Loader;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arCurrentValues */
Loader::includeModule('iblock');

$arComponentParameters = [
    "PARAMETERS" => [
        "VARIABLE_ALIASES" => [//псевдоимена
            "MODEL" => [
                "NAME" => 'ID модели',
            ],
            "BRAND" => [
                "NAME" => 'ID бренда',
            ],
            "NOTEBOOK" => [
                "NAME" => 'ID ноутбука'
            ],
        ],
        "SEF_MODE" => [
            "detail" => [
                "NAME" => 'Детальная страница',
                "DEFAULT" => "detail/#DETAIL#/",
                "VARIABLES" => []
            ],
            "brand" => [
                "NAME" => 'Список производителей',
                "DEFAULT" => "",
                "VARIABLES" => [
                ],
            ],
            "model" => [
                "NAME" => 'Список моделей',
                "DEFAULT" => "#BRAND#/",
                "VARIABLES" => [
                    "BRAND"
                ],
            ],
            "product" => [
                "NAME" => 'Список товаров',
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
