<?php

namespace Foo\Catalog\Setup\DataProvider\Entity\Printer;

use Foo\Catalog\Setup\DataProvider\Entity\ProductInterface;

/**
 * Envelope. Is used for creating preconfigured printer instance
 */
abstract class EnvlpPrinterProduct implements PrinterProductInterface
{
    /**
     * @var PrinterProductInterface
     */
    protected PrinterProductInterface $origin;

    /**
     * Cntr
     * @param PrinterProductInterface $origin
     */
    public function __construct(PrinterProductInterface $origin)
    {
        $this->origin = $origin;
    }

    /**
     * @inheritDoc
     */
    public function with(string $key, mixed $val): PrinterProductInterface
    {
        $that = $this->blueprinted();
        $that->origin = $this->origin->with($key, $val);
        return $that;
    }

    /**
     * @inheritDoc
     */
    public function finished(): ProductInterface
    {
        return $this->origin->finished();
    }

    /**
     * Clones the instance
     * @return self
     */
    abstract public function blueprinted(): self;
}