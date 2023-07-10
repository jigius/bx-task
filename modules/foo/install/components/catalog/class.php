<?php
/**
 * Complex component
 */
use Bitrix\Main;
use Bitrix\Iblock;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (!CModule::IncludeModule('iblock')) {
    die();
}

/**
 * Complex component. Is used for pass a user's request to one of defined plain component.
 */
class ComplexComponent extends CBitrixComponent
{
    /**
     * @var array
     */
    private array $arComponentVariables;

    /**
     * Cntr
     * @param $component
     */
    public function __construct($component = null)
    {
        parent::__construct($component);
        $this->arComponentVariables = ["BRAND", "MODEL", "DETAIL"];
    }

    /**
     * @inheritDoc
     */
    public function executeComponent(): void
    {
        try {
            if ($this->arParams["SEF_MODE"] === "Y") {
                $componentPage = $this->sefMode();
            } else {
                $componentPage = $this->plainMode();
            }
            if (!$componentPage) {
                throw new RuntimeException("page not found", 404);
            }
            $this->IncludeComponentTemplate($componentPage);
        } catch (RuntimeException $ex) {
            if ($ex->getCode() === 404) {
                $this->page404();
            } else {
                throw $ex;
            }
        } catch (Throwable $ex) {
            /**
             * TODO: Show error page!
             */
            throw $ex;
        }
    }

    /**
     * Returns a plain component page when the component works in the SEF-mode
     * @return string
     */
    private function sefMode(): string
    {
        $arDefaultVariableAliases = [];
        $arDefaultUrlTemplates = [
            "brand" => "",
            "model" => "#BRAND#/",
            "detail" => "detail/#DETAIL#/",
            "product" => "#BRAND#/#MODEL#/",
        ];
        $arVariables = [];
        $engine = new CComponentEngine($this);
        $engine->setResolveCallback(["CIBlockFindTools", "resolveComponentEngine"]);
        $arUrlTemplates =
            CComponentEngine::makeComponentUrlTemplates(
                $arDefaultUrlTemplates,
                $this->arParams["SEF_URL_TEMPLATES"]
            );
        $arVariableAliases =
            CComponentEngine::makeComponentVariableAliases(
                $arDefaultVariableAliases,
                $this->arParams["VARIABLE_ALIASES"]
            );
        $target = $engine->guessComponentPath(
            $this->arParams["SEF_FOLDER"],
            $arUrlTemplates,
            $arVariables
        );
        if (
            $target === false &&
            Main\Context::getCurrent()->getRequest()->getRequestedPage() === $this->arParams['SEF_FOLDER'] . "index.php"
        ) {
            $target = 'brand';
        }
        CComponentEngine::initComponentVariables(
            $target,
            $this->arComponentVariables,
            $arVariableAliases,
            $arVariables
        );
        $this->arResult = [
            "VARIABLES" => $arVariables,
            "ALIASES" => $arVariableAliases
        ];
        return $target;
    }

    /**
     * Returns a plain component page when the component works in the PLAIN-mode
     * @return string
     */
    private function plainMode(): string
    {
        $arVariables = [];
        $arDefaultVariableAliases = [];
        $arVariableAliases =
            CComponentEngine::makeComponentVariableAliases(
                $arDefaultVariableAliases,
                $this->arParams["VARIABLE_ALIASES"]
            );
        CComponentEngine::initComponentVariables(
            false,
            $this->arComponentVariables,
            $arVariableAliases,
            $arVariables
        );
        if (isset($arVariables["BRAND"]) && $arVariables["BRAND"] > 0) {
            if (isset($arVariables["MODEL"]) && (int)$arVariables["MODEL"] > 0) {
                $target = "product";
            } else {
                $target = "model";
            }
        } elseif (isset($arVariables["DETAIL"]) && $arVariables["DETAIL"] > 0) {
            $target = "detail";
        } else {
            $target = "brand";
        }
        $this->arResult = [
            "VARIABLES" => $arVariables,
            "ALIASES" => $arVariableAliases
        ];
        return $target;
    }

    /**
     * Outputs page with error 404
     * @return void
     */
    private function page404(): void
    {
        Iblock\Component\Tools::process404(
            $this->arParams["MESSAGE_404"],
            $this->arParams["SET_STATUS_404"] === "Y",
            $this->arParams["SET_STATUS_404"] === "Y",
            $this->arParams["SHOW_404"] === "Y",
            $this->arParams["FILE_404"]
        );
    }
}
