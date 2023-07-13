<?php

/**
 * @var Bitrix\Main\Application $APPLICATION
 */
?>
<form action="<?= $APPLICATION->GetCurPage() ?>">
    <?= bitrix_sessid_post() ?>
    <input type="hidden" name="lang" value="<?= LANGUAGE_ID ?>" />
    <input type="hidden" name="id" value="foo" />
    <input type="hidden" name="uninstall" value="Y" />
    <input type="hidden" name="step" value="2" />
    <?= (new CAdminMessage(GetMessage("MOD_UNINST_WARN")))->Show() ?>
    <p><?= GetMessage("MOD_UNINST_SAVE") ?></p>
    <p>
        <input type="checkbox" name="savedata" id="savedata" value="1" checked />
        <label for="savedata"><?= GetMessage("MOD_UNINST_SAVE_TABLES") ?></label>
    </p>
    <input type="submit" name="inst" value="<?= GetMessage("MOD_UNINST_DEL") ?>">
</form>
