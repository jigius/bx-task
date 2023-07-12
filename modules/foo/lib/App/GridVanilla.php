<?php

namespace Foo\Catalog\App;

use Bitrix\Main;
use CMain;
use CAjax;
use Foo\Catalog\App\URN\UrnInterface;
use LogicException;

/**
 * Vanilla grid instance for the outputting items in the form of table
 */
final class GridVanilla implements GridInterface
{
    /**
     * @var FilterInterface
     */
    private FilterInterface $filter;
    /**
     * @var PaginationInterface
     */
    private PaginationInterface $nav;
    /**
     * @var array{query: Main\ORM\Query\Query|null}
     */
    private array $i;
    /**
     * @var UrnItemInterface
     */
    private UrnItemInterface $urn;

    /**
     * Cntr
     * @param FilterInterface $filter
     * @param PaginationInterface $nav
     * @param UrnItemInterface $urn
     */
    public function __construct(FilterInterface $filter, PaginationInterface $nav, UrnItemInterface $urn)
    {
        $this->filter = $filter;
        $this->nav = $nav;
        $this->urn = $urn;
        $this->i = [
            'columns' => [
                [
                    'id' => 'ID',
                    'name' => GetMessage("FOO_CATALOG_GRID_LBL_FID"),
                    'sort' => 'ID',
                    'default' => true
                ],
                [
                    'id' => 'CREATED',
                    'name' => GetMessage("FOO_CATALOG_GRID_LBL_FCREATED"),
                    'sort' => 'CREATED',
                    'default' => true
                ],
                [
                    'id' => 'NAME',
                    'name' => GetMessage("FOO_CATALOG_GRID_LBL_FNAME"),
                    'sort' => 'NAME',
                    'default' => true
                ]
            ]
        ];
    }

    /**
     * @inheritDoc
     */
    public function withQuery(Main\ORM\Query\Query $query): self
    {
        $that = $this->blueprinted();
        $that->i['query'] = $query;
        return $that;
    }

    /**
     * @inheritDoc
     */
    public function withColumn(string $id, string $name): self
    {
        $that = $this->blueprinted();
        $that->i['columns'][] = ['id' => $id, 'name' => $name, 'sort' => $id, 'default' => true];
        return $that;
    }

    /**
     * @inheritDoc
     * @throws LogicException
     */
    public function filter(): FilterInterface
    {
        if (!isset($this->i['id'])) {
            throw new LogicException("`id` is not defined");
        }
        return $this->filter->withId($this->i['id']);
    }

    /**
     * @inheritDoc
     */
    public function withId(string $id): self
    {
        $that = $this->blueprinted();
        $that->i['id'] = $id;
        return $that;
    }

    /**
     * @inheritDoc
     * @throws LogicException|Main\ObjectPropertyException|Main\SystemException
     */
    public function output(CMain $app, string $template = ".default"): void
    {
        if (!isset($this->i['id'])) {
            throw new LogicException("`id` is not defined");
        }
        if (!isset($this->i['query'])) {
            throw new LogicException("`query` is not defined");
        }
        $opts = new Main\Grid\Options($this->i['id']);
        $nav =
            $this
                ->nav
                ->withId($this->i['id'] . "-nav")
                ->pageNavigation()
                    ->allowAllRecords(true)
                    ->setPageSize(
                        (function (array $cOpts, array $nOpts): int {
                            return $cOpts["page_size"] ?? $nOpts["nPageSize"] ?? 20;
                        })($opts->getCurrentOptions(), $opts->GetNavParams())
                    );
        $nav->initFromUri();
        $query =
            $this
                ->i['query']
                    ->setSelect(["*"])
                    ->setFilter(
                        $this
                            ->filter
                            ->withId($this->i['id'])
                            ->queryData()
                    )
                    ->setOffset($nav->getOffset())
                    ->setLimit($nav->getLimit())
                    ->setOrder(
                        (function (array $opts): array {
                            return $opts['sort'];
                        })($opts->GetSorting(['sort' => ['ID' => 'DESC']]))
                    );
        $totalCount = $query->queryCountTotal();
        $nav->setRecordCount($totalCount);
        $list = array_map(
            function ($row): array {
                return
                    [
                        "data" =>
                            array_reduce(
                                $this->i['columns'],
                                function (array $carry, array $item) use ($row): array {
                                    $carry[$item['id']] = $row[$item['id']] ?? "-";
                                    return $carry;
                                },
                                []
                            ),
                        "actions" => [
                            [
                                "text"    => GetMessage("FOO_CATALOG_GRID_CTRL_VIEW"),
                                'default' => true,
                                "onclick" => "document.location.href=\"{$this->urn->withId((int)$row['ID'])->urn()}\""
                            ]
                        ]
                    ];
            },
            $query->fetchAll()
        );
        $app
            ->IncludeComponent(
                "bitrix:main.ui.grid",
                $template,
                [
                    'GRID_ID' => $this->i['id'],
                    'COLUMNS' => $this->i['columns'],
                    'ROWS' => $list,
                    'SHOW_ROW_CHECKBOXES' => false,
                    'NAV_OBJECT' => $nav,
                    'AJAX_MODE' => 'Y',
                    'AJAX_ID' => CAjax::getComponentID("bitrix:main.ui.grid", ".default", ""),
                    'PAGE_SIZES' => $this->nav->pageSizeVariants(),
                    'TOTAL_ROWS_COUNT'          => $totalCount,
                    'AJAX_OPTION_JUMP'          => 'N',
                    'SHOW_CHECK_ALL_CHECKBOXES' => false,
                    'SHOW_ROW_ACTIONS_MENU'     => true,
                    'SHOW_GRID_SETTINGS_MENU'   => true,
                    'SHOW_NAVIGATION_PANEL'     => true,
                    'SHOW_PAGINATION'           => true,
                    'SHOW_SELECTED_COUNTER'     => false,
                    'SHOW_TOTAL_COUNTER'        => true,
                    'SHOW_PAGESIZE'             => true,
                    'SHOW_ACTION_PANEL'         => true,
                    'ALLOW_COLUMNS_SORT'        => true,
                    'ALLOW_COLUMNS_RESIZE'      => true,
                    'ALLOW_HORIZONTAL_SCROLL'   => true,
                    'ALLOW_SORT'                => true,
                    'ALLOW_PIN_HEADER'          => true,
                    'AJAX_OPTION_HISTORY'       => 'N'
                ]
            );
    }

    /**
     * Clones the instance
     * @return self
     */
    public function blueprinted(): self
    {
        $that = new self($this->filter, $this->nav, $this->urn);
        $that->i = $this->i;
        return $that;
    }
}
