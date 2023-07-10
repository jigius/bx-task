<?php

namespace Foo\Catalog\ORM;

/**
 * Used for the iteration over entities
 */
interface IterableEntitiesInterface
{
    /**
     * @param callable $callee
     * @return void
     */
    public function each(callable $callee): void;
}
