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
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Library</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2><?= htmlentities(GetMessage("FOO_CATALOG_FILTER_HEADER_LBL")) ?></h2>
            <?php $arParams['GRID']->filter()->output($APPLICATION) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h2>
                <?=
                    htmlentities($arParams["FOO_CATALOG_LIST_HEADER_LBL"] ??
                        GetMessage("FOO_CATALOG_LIST_HEADER_LBL"))
                ?>
            </h2>
            <?php $arParams['GRID']->output($APPLICATION) ?>
        </div>
    </div>
</div>
