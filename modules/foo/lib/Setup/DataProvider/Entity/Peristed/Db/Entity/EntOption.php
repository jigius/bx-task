<?php

namespace Foo\Catalog\Setup\DataProvider\Entity\Persisted\Db\Entity;

use Bitrix\Main\SystemException;
use Foo\Catalog\ORM;
use Bitrix\Main;
use Foo\Catalog\Setup\DataProvider\Entity\Persisted\Db;
use Foo\Catalog\Setup\DataProvider\Entity\PropertyInterface;
use LogicException;
use Exception;

/**
 * Instance is used for work with option entity in the persisted layer via bitrix ORM
 */
final class EntOption implements Db\EntityTInterface
{
    /**
     * @var array{property: PropertyInterface|null}
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
     * @param PropertyInterface $p
     * @return self
     */
    public function withProperty(PropertyInterface $p): self
    {
        $that = $this->blueprinted();
        $that->i['property'] = $p;
        return $that;
    }

    /**
     * @inheritDoc
     * @throws LogicException|SystemException
     */
    public function query(): Main\ORM\Query\Query
    {
        if (!isset($this->i['property'])) {
            throw new LogicException("`product` is not defined");
        }
        return ORM\OptionTable::query()
            ->addSelect('ID')
            ->where('NAME', "=", $this->i['property']->name());
    }

    /**
     * @inheritDoc
     * @throws Exception|LogicException
     */
    public function add(): Main\ORM\Data\AddResult
    {
        if (!isset($this->i['property'])) {
            throw new LogicException("`property` is not defined");
        }
        return ORM\OptionTable::add(['NAME' => $this->i['property']->name()]);
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
