<?php
$arComponentDescription = [
    "NAME" => GetMessage("FOO_CATALOG_NAME"),
    "DESCRIPTION" => GetMessage("FOO_CATALOG_DESCRIPTION"),
    "ICON" => "/images/icon.gif",
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
