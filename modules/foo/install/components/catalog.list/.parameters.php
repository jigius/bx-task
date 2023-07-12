<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    throw new LogicException("Environment is invalid");
}
$arSortFields = [
    "ID" => GetMessage("FOO_CATALOG_LIST_DESC_FID"),
    "NAME" => GetMessage("FOO_CATALOG_LIST_DESC_FNAME"),
    "CREATED" => GetMessage("FOO_CATALOG_LIST_DESC_FCREATED"),
];
$arSorts = [
    "ASC"=>GetMessage("FOO_CATALOG_LIST_DESC_ASC"),
    "DESC"=>GetMessage("FOO_CATALOG_LIST_DESC_DESC"),
];

$arComponentParameters = [
    "GROUPS" => [],
    "PARAMETERS" => [
        "SORT_BY" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage("FOO_CATALOG_LIST_DESC_ORDER"),
            "TYPE" => "LIST",
            "DEFAULT" => "ID",
            "VALUES" => $arSortFields,
            "ADDITIONAL_VALUES" => "N",
        ],
        "SORT_ORDER" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage("FOO_CATALOG_LIST_DESC_BY"),
            "TYPE" => "LIST",
            "DEFAULT" => "DESC",
            "VALUES" => $arSorts,
            "ADDITIONAL_VALUES" => "N",
        ],
    ],
];
