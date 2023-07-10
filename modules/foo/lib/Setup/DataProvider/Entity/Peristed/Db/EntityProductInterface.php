<?php

namespace Foo\Catalog\Setup\DataProvider\Entity\Persisted\Db;

use Foo\Catalog\Setup\DataProvider\Entity\ProductInterface;

interface EntityProductInterface
{
    /**
     * @return void
     */
    public function add(): void;

    /**
     * @param ProductInterface $p
     * @return EntityProductInterface
     */
    public function withProduct(ProductInterface $p): EntityProductInterface;
}
