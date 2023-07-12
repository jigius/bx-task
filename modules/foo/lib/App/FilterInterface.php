<?php

namespace Foo\Catalog\App;

use CMain;

/**
 * Filter Interface
 */
interface FilterInterface
{
    /**
     * Outputs the filter's content
     * @param CMain $app
     * @param string $template
     * @return void
     */
    public function output(CMain $app, string $template = ".default"): void;

    /**
     * Appends a filter's item into the bunch
     * @param string $id
     * @param string $name
     * @param string $type
     * @param bool $default
     * @return FilterInterface
     */
    public function withItem(string $id, string $name, string $type, bool $default = true): FilterInterface;

    /**
     * Returns array of values which is used with orm query
     * @return array
     */
    public function queryData(): array;

    /**
     * Defines filter's ID
     * @param string $id
     * @return FilterInterface
     */
    public function withId(string $id): FilterInterface;
}
