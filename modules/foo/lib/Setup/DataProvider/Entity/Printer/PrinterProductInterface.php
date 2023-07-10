<?php

namespace Foo\Catalog\Setup\DataProvider\Entity\Printer;

use Foo\Catalog\Foundation as F;
use Foo\Catalog\Setup\DataProvider\Entity\ProductInterface;

/**
 * Prints a product entity
 */
interface PrinterProductInterface extends F\PrinterInterface
{
    /**
     * @inheritDoc
     * @return PrinterProductInterface
     */
    public function with(string $key, mixed $val): PrinterProductInterface;

    /**
     * @inheritDoc
     * @return ProductInterface
     */
    public function finished(): ProductInterface;
}
