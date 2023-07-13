<?php

/**
 * @var CMain $APPLICATION
 * @var CUser $user
 * @var Bitrix\Main\DB\Connection $DB
 * @var CBitrixComponentTemplate $this
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array{ITEMS: array{NAME: string, HREF: string}} $arResult
 * @var array $arLangMessages
 * @var string $templateFolder
 * @var string $templateName
 * @var string $componentPath
 * @var string $parentTemplateFolder
 * @var array $templateData
 */
?>
<?php if (!empty($arResult['ITEMS'])): ?>
<?php
    $items = array_values($arResult["ITEMS"]);
    $lastIdx = count($arResult["ITEMS"]) - 1;
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <?php foreach ($items as $idx => $itm): ?>
                    <li class="breadcrumb-item<?= $idx == $lastIdx ? " active\" aria-current=\"page" : "" ?>">
                        <?php if (!empty($itm['HREF'])): ?>
                        <a href="<?= $itm["HREF"] ?>"><?= htmlentities($itm['NAME']) ?></a>
                        <?php else: ?>
                        <?= htmlentities($itm['NAME']) ?>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                </ol>
            </nav>
        </div>
    </div>
</div>
<?php endif; ?>
