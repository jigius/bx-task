<?php

namespace Foo\Catalog\Setup\DataProvider\Entity;

/**
 * Mutable property
 */
interface MutablePropertyInterface extends PropertyInterface
{
    /**
     * @param string $name
     * @return MutablePropertyInterface
     */
    public function withName(string $name): MutablePropertyInterface;

    /**
     * @param string $name
     * @return MutablePropertyInterface
     */
    public function withLabel(string $name): MutablePropertyInterface;
}
