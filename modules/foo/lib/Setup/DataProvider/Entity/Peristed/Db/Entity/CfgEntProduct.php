<?php

namespace Foo\Catalog\Setup\DataProvider\Entity\Persisted\Db\Entity;

use  Foo\Catalog\Setup\DataProvider\Entity\Persisted\Db;
use Foo\Catalog\Setup\DataProvider\Entity\Persisted\Db\EntityProductInterface;
use Foo\Catalog\Setup\DataProvider\Entity\ProductInterface;

/**
 * Configured product entity for the project
 */
final class CfgEntProduct extends EnvlpEntityProduct
{
    /**
     * Cntr
     */
    public function __construct()
    {
        $look =
            new Db\LkPkWithAddedEntityIfNotFound(
                new Db\LkPkExistedEntity()
            );
        parent::__construct(
            new EntProduct(
                new EntModel(new EntManufacturer(), $look),
                new EntOption(),
                $look
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function withProduct(ProductInterface $p): EntityProductInterface
    {
        $that = $this->blueprinted();
        $that->origin = $this->origin->withProduct($p);
        return $that;
    }

    /**
     * @inheritDoc
     */
    public function blueprinted(): EnvlpEntityProduct
    {
        $that =  new self();
        $that->origin = $this->origin;
        return $that;
    }
}
