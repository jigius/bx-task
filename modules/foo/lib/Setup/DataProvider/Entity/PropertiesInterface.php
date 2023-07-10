<?php

namespace Foo\Catalog\Setup\DataProvider\Entity;

/**
 * Properties
 */
interface PropertiesInterface
{
    /**
     * @param PropertyInterface $prop
     * @return PropertiesInterface
     */
    public function with(PropertyInterface $prop): PropertiesInterface;
    /**
     * @param callable $callee
     * @return void
     */
    public function each(callable $callee): void;
}