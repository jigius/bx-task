<?php

namespace Foo\Catalog\Setup\DataProvider\Entity\Printer;

use Foo\Catalog\Setup\DataProvider\Entity as L;

/**
 * Printers (created) product entity
 */
final class CfgPrnProduct extends EnvlpPrinterProduct
{
    /**
     * Cntr
     */
    public function __construct()
    {
        parent::__construct(
            new PrnProduct(
                new L\EntProductWithThrowExceptionIfValueIsEmpty(
                    new L\EntProductWithTrimmedValues(
                        new L\EntProduct()
                    )
                ),
                new L\EntPropertyWithAddedLabelToValue(
                    new L\EntPropertyWithThrowExceptionIfValueIsEmpty(
                        new L\EntPropertyWithTrimmedValue(
                            new L\EntProperty()
                        )
                    )
                )
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function blueprinted(): self
    {
        $that = new self();
        $that->origin = $this->origin;
        $that->i = $this->i;
        return $that;
    }
}