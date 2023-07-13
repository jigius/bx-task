<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = [
    "NAME" => GetMessage("FOO_CATALOG_DETAIL_NAME"),
    "DESCRIPTION" => GetMessage("FOO_CATALOG_DETAIL_DESCRIPTION"),
    "ICON" => "/images/icon.gif",
    "SORT" => 30,
    "PATH" => [
        "ID" => "content",
        "CHILD" => [
            "ID" => "foo",
            "NAME" => GetMessage("T_FOO_DESC_CATALOG"),
            "SORT" => 10,
            "CHILD" => [
                "ID" => "foo_cmpx",
            ],
        ]
    ],
    "CACHE_PATH" => "Y",
    "COMPLEX" => "N"
];
