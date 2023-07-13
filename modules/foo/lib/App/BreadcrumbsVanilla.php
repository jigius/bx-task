<?php

namespace Foo\Catalog\App;

use CMain;

/**
 * Implements breadcrumbs
 */
final class BreadcrumbsVanilla implements BreadcrumbsInterface
{
    /**
     * @var array
     */
    private array $i;

    /**
     * Cntr
     */
    public function __construct()
    {
        $this->i = [];

    }
    /**
     * @inheritDoc
     */
    public function withItem(string $name, string $href): self
    {
        $that = $this->blueprinted();
        $that->i[] = ['NAME' => $name, "HREF" => $href];
        return $that;
    }

    /**
     * @inheritDoc
     */
    public function output(CMain $app, string $template = ".default"): void
    {
        $app->IncludeComponent(
            "foo:catalog.bc",
            $template,
            [
                'ITEMS' => $this->i
            ]
        );
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
