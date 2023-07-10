<?php

namespace Foo\Catalog\Setup\DataProvider\Entity;

/**
 * Mutable notebook
 */
interface MutableProductInterface extends ProductInterface
{
    /**
     * @param string $name
     * @return MutableProductInterface
     */
    public function withManufacturer(string $name): MutableProductInterface;

    /**
     * @param string $name
     * @return MutableProductInterface
     */
    public function withModel(string $name): MutableProductInterface;

    /**
     * @param string $name
     * @return MutableProductInterface
     */
    public function withName(string $name): MutableProductInterface;

    /**
     * @param int $price
     * @return MutableProductInterface
     */
    public function withPrice(int $price): MutableProductInterface;

    /**
     * @param int $year
     * @return MutableProductInterface
     */
    public function withIssued(int $year): MutableProductInterface;

    /**
     * @param PropertyInterface $prop
     * @return MutableProductInterface
     */
    public function withProperty(PropertyInterface $prop): MutableProductInterface;
}
