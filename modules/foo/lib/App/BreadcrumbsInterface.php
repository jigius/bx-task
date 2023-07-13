<?php

namespace Foo\Catalog\App;

use CMain;

/**
 * Breadcrumb
 */
interface BreadcrumbsInterface
{
    /**
     * @param string $name
     * @param string $href
     * @return BreadcrumbsInterface
     */
    public function withItem(string $name, string $href): BreadcrumbsInterface;

    /**
     * @param CMain $app
     * @param string $template
     * @return void
     */
    public function output(CMain $app, string $template = ".default"): void;
}
