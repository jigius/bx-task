<?php
/**
 * @var Bitrix\Main\Application $APPLICATION
 */
if(!check_bitrix_sessid()) return;

if ($ex = $APPLICATION->GetException()) {
    echo
        (new CAdminMessage([
            "TYPE" => "ERROR",
            "MESSAGE" => GetMessage("MOD_INST_ERR"),
            "DETAILS" => $ex->GetString(),
            "HTML" => true,
        ]))
	        ->Show();
} else {
	CAdminMessage::ShowNote(GetMessage("MOD_INST_OK"));
}
?>
<form action="<?= $APPLICATION->GetCurPage() ?>">
	<input type="hidden" name="lang" value="<?= LANG ?>">
	<input type="submit" name="" value="<?= GetMessage("MOD_BACK") ?>">
<form>