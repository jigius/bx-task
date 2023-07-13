<?php

use Foo\Catalog as L;
use Bitrix\Main;

require_once __DIR__ . "/../vendor/autoload.php";
IncludeModuleLangFile(__FILE__);

if (class_exists("foo")) {
    return;
}

class foo extends CModule
{
    /**
     * Cntr
     */
    function __construct()
    {
        $arModuleVersion = [];
        include(__DIR__ . "/version.php");
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->MODULE_ID = "foo";
        $this->MODULE_NAME = GetMessage("FOO_MODULE_NAME");
        $this->MODULE_DESCRIPTION = GetMessage("FOO_MODULE_DESCRIPTION");
        $this->MODULE_GROUP_RIGHTS = "Y";
    }

    /**
     * @return void
     */
    public function DoInstall(): void
    {
        global $DOCUMENT_ROOT, $APPLICATION, $step, $footprint;
        $RIGHT = $APPLICATION->GetGroupRight($this->MODULE_ID);
        if ($RIGHT >= "W") {
            try {
                $tplFile = "/step1.php";
                $step = intval($step);
                if ($step < 2) {
                    $footprint = (new Foo\Catalog\Setup\DbSchemePrj())->hasFootprints();
                } elseif ($step == 2) {
                    $tplFile = "/step2.php";
                    (new L\Setup\TskInstall(
                        Main\Application::getConnection(),
                        new L\ORM\ConfiguredEntities(),
                        __DIR__ . "/samples_data.csv",
                        new L\Setup\FilePathsPrj($DOCUMENT_ROOT),
                        !!($_REQUEST['clean'] ?? false)
                    ))
                        ->executed();
                    RegisterModule($this->MODULE_ID);
                }
            } catch (Throwable $ex) {
                $APPLICATION->ThrowException(GetMessage("FOO_ERROR_OCCURRED"));
            }
            $APPLICATION->IncludeAdminFile(GetMessage("FOO_INSTALL_TITLE"), __DIR__ . $tplFile);
        }
    }

    /**
     * @return array[]
     */
    public function GetModuleRightList(): array
    {
        return
            [
                "reference_id" => ["D", "R", "W"],
                "reference" => [
                    "[D] " . GetMessage("FOO_CATALOG_RIGHT_DENIED"),
                    "[R] " . GetMessage("FOO_CATALOG_RIGHT_VIEW"),
                    "[W] " . GetMessage("FOO_CATALOG_RIGHT_ADMIN")
                ]
            ];
    }

    /**
     * @return void
     */
    public function DoUninstall(): void
    {
        global $DOCUMENT_ROOT, $APPLICATION, $step;
        $RIGHT = $APPLICATION->GetGroupRight($this->MODULE_ID);
        if ($RIGHT >= "W") {
            try {
                $tplFile = "/unstep1.php";
                $step = intval($step);
                if ($step == 2) {
                    $tplFile = "/unstep2.php";
                    (new L\Setup\TskUninstall(
                        new L\ORM\ConfiguredEntities(),
                        new L\Setup\FilePathsPrj($DOCUMENT_ROOT),
                        !!($_REQUEST['savedata'] ?? false)
                    ))
                        ->executed();
                    UnregisterModule($this->MODULE_ID);
                }
            } catch (Throwable $ex) {
                $APPLICATION->ThrowException(GetMessage("FOO_ERROR_OCCURRED"));
            }
            $APPLICATION->IncludeAdminFile(GetMessage("FOO_UNINSTALL_TITLE"), __DIR__ . $tplFile);
        }
    }

    /**
     * @return void
     */
    public function InstallEvents(): void
    {
    }

    /**
     * @return void
     */
    public function UnInstallEvents(): void
    {
    }

    /*function GetModuleRightList()
    {
        $arr = array(
            "reference_id" => array("D","R","W"),
            "reference" => array(
                "[D] ".GetMessage("PERF_DENIED"),
                "[R] ".GetMessage("PERF_VIEW"),
                "[W] ".GetMessage("PERF_ADMIN"))
        );
        return $arr;
    }*/
}
