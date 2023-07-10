<?php

namespace Foo\Catalog\Setup\DataProvider\Entity\Persisted\Db\Entity;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\SystemException;
use Foo\Catalog\ORM;
use Bitrix\Main;
use Foo\Catalog\Setup\DataProvider\Entity\Persisted\Db;
use Foo\Catalog\Setup\DataProvider\Entity\ProductInterface;
use LogicException;
use Exception;

/**
 * Instance is used for work with manufacturer entity in the persisted layer via bitrix ORM
 */
final class EntManufacturer implements Db\EntityTInterface
{
    /**
     * @var array
     */
    private array $i;

    /**
     * Cntr
     */
    public function __construct()
    {
        $this->i = [];
    }

    /**
     * @param ProductInterface $p
     * @return self
     */
    public function withProduct(ProductInterface $p): self
    {
        $that = $this->blueprinted();
        $that->i['product'] = $p;
        return $that;
    }

    /**
     * @inheritDoc
     * @throws ArgumentException|SystemException
     */
    public function query(): Main\ORM\Query\Query
    {
        if (!isset($this->i['product'])) {
            throw new LogicException("`product` is not defined");
        }
        return ORM\ManufacturerTable::query()
            ->addSelect('ID')
            ->where('NAME', "=", $this->i['product']->manufacturer());
    }

    /**
     * @inheritDoc
     * @throws Exception|LogicException
     */
    public function add(): Main\ORM\Data\AddResult
    {
        if (!isset($this->i['product'])) {
            throw new LogicException("`product` is not defined");
        }
        return ORM\ManufacturerTable::add(['NAME' => $this->i['product']->manufacturer()]);
    }

    /**
     * Clones the instance
     * @return self
     */
    public function blueprinted(): self
    {
        $that = new self();
        $that->i = $this->i;
        return $that;
    }
}
