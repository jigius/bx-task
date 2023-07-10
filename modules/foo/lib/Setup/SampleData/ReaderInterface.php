<?php

namespace Foo\Catalog\Setup\DataProvider\Reader;

use Iterator;

/**
 * Reader contract
 */
interface ReaderInterface extends Iterator
{
    /**
     * @inheritDoc
     * @return array
     */
    public function current(): array;
}
