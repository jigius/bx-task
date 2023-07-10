<?php

namespace Foo\Catalog\Setup\DataProvider\Entity;

/**
 * Notebook
 */
interface ProductInterface
{
    /**
     * @return string
     */
    public function manufacturer(): string;

    /**
     * @return string
     */
    public function model(): string;

    /**
     * @return string
     */
    public function name(): string;

    /**
     * @return int
     */
    public function price(): int;

    /**
     * @return int
     */
    public function issued(): int;

    /**
     * @return PropertiesInterface
     */
    public function properties(): PropertiesInterface;
}
