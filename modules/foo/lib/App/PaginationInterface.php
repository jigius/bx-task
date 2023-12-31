<?php

namespace Foo\Catalog\App;

use Bitrix\Main\UI;

interface PaginationInterface
{
    /**
     * Defines pagenavigation's ID
     * @param string $id
     * @return PaginationInterface
     */
    public function withId(string $id): PaginationInterface;

    /**
     * Returns stock bx instance
     * @return UI\PageNavigation
     */
    public function pageNavigation(): UI\PageNavigation;

    /**
     * @param string $name
     * @param int $count
     * @return PaginationInterface
     */
    public function withPageSizeVariant(string $name, int $count): PaginationInterface;

    /**
     * @return array{NAME: string, VALUE: int}
     */
    public function pageSizeVariants(): array;
}
