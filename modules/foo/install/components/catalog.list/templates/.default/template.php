<?php

use Foo\Catalog;

/**
 * @var CMain $APPLICATION
 * @var CUser $user
 * @var Bitrix\Main\DB\Connection $DB
 * @var CBitrixComponentTemplate $this
 * @var CBitrixComponent $component
 * @var array{
 *     GRID: Catalog\App\GridInterface,
 *     LIST_HEADER_LBL: string,
 *     BREADCRUMBS: Catalog\App\BreadcrumbsInterface
 * } $arResult
 * @var array $arParams
 * @var array $arLangMessages
 * @var string $templateFolder
 * @var string $templateName
 * @var string $componentPath
 * @var string $parentTemplateFolder
 * @var array $templateData
 */
?>
<?php $arResult['BREADCRUMBS']->output($APPLICATION, ".default") ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2><?= htmlentities(GetMessage("FOO_CATALOG_FILTER_HEADER_LBL")) ?></h2>
            <?php $arResult['GRID']->filter()->output($APPLICATION) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h2>
                <?=
                    htmlentities(
                        $arResult["LIST_HEADER_LBL"] ??
                        GetMessage("FOO_CATALOG_LIST_HEADER_LBL")
                    )
                ?>
            </h2>
            <?php $arResult['GRID']->output($APPLICATION) ?>
        </div>
    </div>
</div>
