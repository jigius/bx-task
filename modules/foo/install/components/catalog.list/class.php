<?php
/**
 *
 * Plain component. Is used for output items
 *
 */

use Bitrix\Main;
use Foo\Catalog;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    throw new LogicException("Environment is broken :(");
}

Main\Loader::includeModule('foo');
IncludeModuleLangFile(__FILE__);

final class FooCatalogList extends CBitrixComponent
{
    /**
     * Cntr
     * @param $component
     */
    public function __construct($component = null)
    {
        parent::__construct($component);
    }

    /**
     * @inheritDoc
     */
    public function executeComponent(): void
    {
        $urn0 =
            (new Catalog\App\URN\UrnVanilla(
                ($this->arParams["SEF_MODE"] ?? "N") === "Y"))
                ->withBasePath(
                    !empty($this->arParams["SEF_FOLDER"]) ?
                        $this->arParams["SEF_FOLDER"] :
                        GetDirPath(GetPagePath())
                );
        $bc = new Catalog\App\BreadcrumbsVanilla();
        $grid = new Catalog\App\GridVanilla(new Catalog\App\FilterVanilla(), new Catalog\App\PaginationVanilla());
        if (isset($this->arParams["BRAND_ID"]) && isset($this->arParams["MODEL_ID"])) {
            $model =
                Catalog\ORM\ModelTable::getByPrimary(
                    (int)$this->arParams["MODEL_ID"],
                    [
                        "select" => ["MANUFACTURER_ID", "MANUFACTURER", "NAME"]
                    ]
                )
                    ->fetchObject();
            if ($model === null) {
                throw new RuntimeException("not found", 404);
            }
            if ($model->getManufacturerId() !== (int)$this->arParams["BRAND_ID"]) {
                throw new RuntimeException("not found", 404);
            }
            $this->arResult["GRID"] =
                $grid
                    ->withId("prod")
                        ->withQuery(
                            Catalog\ORM\ProductTable::query()
                                ->where("MODEL_ID", "=", (int)$this->arParams["MODEL_ID"])
                        )
                        ->withColumn("ISSUED", GetMessage("FOO_CATALOG_GRID_LBL_FISSUED"))
                        ->withColumn("PRICE", GetMessage("FOO_CATALOG_GRID_LBL_FPRICE"))
                        ->withUrn(
                            new Catalog\App\UrnItemProduct(
                                $urn0
                                    ->withModel((int)$this->arParams["MODEL_ID"])
                                    ->withManufacturer((int)$this->arParams["BRAND_ID"])
                            )
                        );
            $headerLbl = GetMessage("FOO_CATALOG_LIST_HEADER_PRODUCTS");
            $bc =
                $bc
                    ->withItem(
                        GetMessage("FOO_CATALOG_DETAIL_BC_MANUFACTURER_ALL"),
                        $urn0->urn()
                    )
                    ->withItem(
                        $model->getManufacturer()->getName(),
                        $urn0->withManufacturer((int)$this->arParams["BRAND_ID"])->urn()
                    )
                    ->withItem($model->getName(), "");
        } elseif (isset($this->arParams["BRAND_ID"])) {
            $manufacturer =
                Catalog\ORM\ManufacturerTable::getByPrimary(
                    (int)$this->arParams["BRAND_ID"],
                    [
                        "select" => ["NAME"]
                    ]
                )
                    ->fetchObject();
            if ($manufacturer === null) {
                throw new RuntimeException("not found", 404);
            }
            $this->arResult["GRID"] =
                $grid
                    ->withId("model")
                    ->withQuery(
                        Catalog\ORM\ModelTable::query()
                            ->where("MANUFACTURER_ID", "=", (int)$this->arParams["BRAND_ID"])
                    )
                    ->withUrn(
                        new Catalog\App\UrnItemModel(
                            $urn0->withManufacturer((int)$this->arParams["BRAND_ID"])
                        )
                    );
            $headerLbl = GetMessage("FOO_CATALOG_LIST_HEADER_MODEL");
            $bc =
                $bc
                    ->withItem(
                        GetMessage("FOO_CATALOG_DETAIL_BC_MANUFACTURER_ALL"),
                        $urn0->urn()
                    )
                    ->withItem($manufacturer->getName(), "");
        } else {
            $this->arResult["GRID"] =
                $grid
                    ->withId("brand")
                    ->withQuery(
                        Catalog\ORM\ManufacturerTable::query()
                    )
                    ->withUrn(new Catalog\App\UrnItemManufacturer($urn0));
            $headerLbl = GetMessage("FOO_CATALOG_LIST_HEADER_MANUFACTURER");
        }
        $this->arResult["LIST_HEADER_LBL"] = $headerLbl;
        $this->arResult["BREADCRUMBS"] = $bc;
        $this->includeComponentTemplate();
    }
}
