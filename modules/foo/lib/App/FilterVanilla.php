<?php

namespace Foo\Catalog\App;

use Bitrix\Main\UI\Filter;
use CMain;
use LogicException;

/**
 * Vanilla filter instance
 */
final class FilterVanilla implements FilterInterface
{
    /**
     * @var array{item: array{id: string, name: string, type: string, default: bool}, id: string}
     */
    private array $i;

    /**
     * Cntr
     */
    public function __construct()
    {
        $this->i = [
            'item' => []
        ];
    }

    /**
     * @inheritDoc
     */
    public function output(CMain $app, string $template = ".default"): void
    {
        if (!isset($this->i['id'])) {
            throw new LogicException("filter's id is not defined");
        }
        $app->IncludeComponent(
            "bitrix:main.ui.filter",
            $template,
            [
                'FILTER_ID' => $this->i['id'],
                'GRID_ID' => $this->i['id'],
                'FILTER' => $this->i['items'],
                'ENABLE_LIVE_SEARCH' => true,
                'ENABLE_LABEL' => false,
                'ENABLE_FIELDS_SEARCH' => false,
                'FILTER_PRESETS' => []
            ]
        );
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
     */
    public function withItem(string $id, string $name, string $type, bool $default = true): self
    {
        $that = $this->blueprinted();
        $that->i['item'][] = [
            'id' => $id,
            'name' => $name,
            'type' => $type,
            'default' => $default
        ];
        return $that;
    }

    /**
     * @inheritDoc
     * @throws LogicException
     */
    public function queryData(): array
    {
        if (!isset($this->i['id'])) {
            throw new LogicException("filter's id is not defined");
        }
        $filterData = (new Filter\Options($this->i['id']))->getFilter();
        $ret = [];
        if (!empty(trim($filterData['FIND']))) {
            $ret['NAME'] = "%" . trim($filterData['FIND']) . "%";
        }
        /**
         * TODO: what's about others filter's fields?!
         */
        return $ret;
    }

    /**
     * Clones the instance
     * @return self
     */
    public function blueprinted(): self
    {
        $that = new self();
        $that->i = $this->i;
        return $that;
    }
}
