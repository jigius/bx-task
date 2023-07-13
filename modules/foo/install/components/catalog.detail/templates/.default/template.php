<?php

use Foo\Catalog;

/**
 * @var CMain $APPLICATION
 * @var CUser $user
 * @var Bitrix\Main\DB\Connection $DB
 * @var CBitrixComponentTemplate $this
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array{
 *     PRODUCT: Catalog\ORM\Product,
 *     MODEL: Catalog\ORM\Model,
 *     MANUFACTURER: Catalog\ORM\Manufacturer,
 *     OPTIONS: Catalog\ORM\ProductOption[],
 *     MODEL_URN: Catalog\App\URN\UrnInterface,
 *     MANUFACTURER_URN: Catalog\App\URN\UrnInterface,
 *     BREADCRUMBS: Catalog\App\BreadcrumbsInterface
 * } $arResult
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
            <table class="table">
                <tbody>
                <tr>
                    <th scope="row" class="text-right">
                        <?= htmlentities(GetMessage("FOO_CATALOG_DETAIL_LABEL_NAME")) ?>
                    </th>
                    <td><?= htmlentities($arResult['PRODUCT']->getName()) ?></td>
                </tr>
                <tr>
                    <th scope="row" class="text-right">
                        <?= htmlentities(GetMessage("FOO_CATALOG_DETAIL_LABEL_MODEL")) ?>
                    </th>
                    <td>
                        <a href="<?= $arResult['MODEL_URN']->urn() ?>">
                            <?= htmlentities($arResult['MODEL']->getName()) ?>
                        </a>
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="text-right">
                        <?= htmlentities(GetMessage("FOO_CATALOG_DETAIL_LABEL_ISSUED")) ?>
                    </th>
                    <td><?= htmlentities($arResult['PRODUCT']->getIssued()) ?></td>
                </tr>
                <?php if (!empty($arResult['OPTIONS'])): ?>
                <tr>
                    <th scope="row" class="text-right">
                        <?= htmlentities(GetMessage("FOO_CATALOG_DETAIL_LABEL_OPTIONS")) ?>
                    </th>
                    <td>
                        <ul>
                            <?php foreach ($arResult['OPTIONS'] as $option): ?>
                            <li><?= htmlentities($option->getName()) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                </tr>
                <?php endif; ?>
                <tr>
                    <th scope="row" class="text-right">
                        <?= htmlentities(GetMessage("FOO_CATALOG_DETAIL_LABEL_MANUFACTURER")) ?>
                    </th>
                    <td>
                        <a href="<?= $arResult['MANUFACTURER_URN']->urn() ?>">
                            <?= htmlentities($arResult['MANUFACTURER']->getName()) ?>
                        </a>
                </tr>
                <tr>
                    <th scope="row" class="text-right">
                        <?= htmlentities(GetMessage("FOO_CATALOG_DETAIL_LABEL_PRICE")) ?>
                    </th>
                    <td><?= htmlentities($arResult['PRODUCT']->getPrice()) ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
