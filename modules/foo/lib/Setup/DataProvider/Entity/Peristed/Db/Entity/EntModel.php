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
 * Instance is used for work with model entity in the persisted layer via bitrix ORM
 */
final class EntModel implements Db\EntityTInterface
{
    /**
     * @var array
     */
    private array $i;
    /**
     * @var EntManufacturer
     */
    private EntManufacturer $man;
    /**
     * @var Db\LookupCapablePKInterface
     */
    private Db\LookupCapablePKInterface $look;

    /**
     * Cntr
     */
    public function __construct(EntManufacturer $man, Db\LookupCapablePKInterface $look)
    {
        $this->man = $man;
        $this->look = $look;
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
        return ORM\ModelTable::query()
            ->addSelect('ID')
            ->where('NAME', "=", $this->i['product']->model());
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
        return ORM\ModelTable::add(
            [
                'NAME' => $this->i['product']->model(),
                'MANUFACTURER_ID' => $this->look->pk($this->man->withProduct($this->i['product'])),
            ]
        );
    }

    /**
     * Clones the instance
     * @return self
     */
    public function blueprinted(): self
    {
        $that = new self($this->man, $this->look);
        $that->i = $this->i;
        return $that;
    }
}
