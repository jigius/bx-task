<?php
/**
 * @var Bitrix\Main\Application $APPLICATION
 */
IncludeModuleLangFile(__FILE__);
?>
<p><?= GetMessage("FOO_INSTALL") ?></p>
<form action="<?= $APPLICATION->GetCurPage() ?>" name="form">
    <?= bitrix_sessid_post() ?>
    <input type="hidden" name="lang" value="<?= LANG ?>" />
    <input type="hidden" name="id" value="foo" />
    <input type="hidden" name="install" value="Y" />
    <input type="hidden" name="step" value="2" />
    <?php if (!empty($footprint)): ?>
    <p><?= GetMessage("FOO_INST_FOUND_DATA")?></p>
    <p>
        <input type="checkbox" name="clean" id="clean" value="1" />
        <label for="clean"><?= GetMessage("FOO_INST_DEL_CTRL_LBL")?></label>
    </p>
    <?php else: ?>
        <input type="hidden" name="clean" value="1" />
    <?php endif; ?>
    <input type="submit" name="inst" value="<?= GetMessage("MOD_INSTALL") ?>">
</form>
