<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    throw new LogicException("Environment is invalid");
}

$arComponentParameters = [
    "GROUPS" => [],
    "PARAMETERS" => [
        "ID" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage("FOO_CATALOG_DETAIL_DESC_ID"),
            "TYPE" => "STRING",
            "DEFAULT" => "",
            "ADDITIONAL_VALUES" => "N"
        ]
    ]
];
