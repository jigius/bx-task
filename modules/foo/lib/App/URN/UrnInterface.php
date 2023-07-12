<?php

namespace Foo\Catalog\App\URN;

/**
 * URN contract for the references creating
 */
interface UrnInterface
{
    /**
     * Defines manufacturer's ID
     * @param int $id
     * @return UrnInterface
     */
    public function withManufacturer(int $id): UrnInterface;

    /**
     * Defines model's ID
     * @param int $id
     * @return UrnInterface
     */
    public function withModel(int $id): UrnInterface;

    /**
     * Defines product's ID
     * @param int $id
     * @return UrnInterface
     */
    public function withProduct(int $id): UrnInterface;

    /**
     * @param string $path
     * @return UrnInterface
     */
    public function withBasePath(string $path): UrnInterface;

    /**
     * @return string
     */
    public function urn(): string;
}
