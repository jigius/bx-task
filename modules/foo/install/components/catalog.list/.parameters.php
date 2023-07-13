<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    throw new LogicException("Environment is invalid");
}

$arComponentParameters = [
    "GROUPS" => [],
    "PARAMETERS" => [
        "BRAND_ID" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => "BRAND_ID",
            "TYPE" => "STRING",
            "DEFAULT" => "",
            "ADDITIONAL_VALUES" => "N"
        ],
        "MODEL_ID" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => "MODEL_ID",
            "TYPE" => "STRING",
            "DEFAULT" => "",
            "ADDITIONAL_VALUES" => "N"
        ],
        "DETAIL_ID" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => "DETAIL_ID",
            "TYPE" => "STRING",
            "DEFAULT" => "",
            "ADDITIONAL_VALUES" => "N"
        ]
    ],
];
