<?php

namespace Foo\Catalog\Setup\DataProvider\Entity;

use LogicException;

/**
 * Vanilla implementation of product entity
 */
final class EntProduct implements MutableProductInterface
{
    /**
     * @var array{properties: PropertiesInterface}
     */
    private array $i;

    /**
     * Cntr
     */
    public function __construct()
    {
        $this->i = [
            'properties' => new EntProperties()
        ];
    }

    /**
     * @inheritDoc
     */
    public function manufacturer(): string
    {
        if (!isset($this->i['manufacturer'])) {
            throw new LogicException("`manufacturer` is not defined");
        }
        return $this->i['manufacturer'];
    }

    /**
     * @inheritDoc
     */
    public function model(): string
    {
        if (!isset($this->i['model'])) {
            throw new LogicException("`model` is not defined");
        }
        return $this->i['model'];
    }

    /**
     * @inheritDoc
     */
    public function name(): string
    {
        if (!isset($this->i['name'])) {
            throw new LogicException("`name` is not defined");
        }
        return $this->i['name'];
    }

    /**
     * @inheritDoc
     */
    public function price(): int
    {
        if (!isset($this->i['price'])) {
            throw new LogicException("`price` is not defined");
        }
        return $this->i['price'];
    }

    /**
     * @inheritDoc
     */
    public function issued(): int
    {
        if (!isset($this->i['year'])) {
            throw new LogicException("`issued` is not defined");
        }
        return $this->i['year'];
    }

    /**
     * @inheritDoc
     */
    public function properties(): PropertiesInterface
    {
        if (!isset($this->i['properties'])) {
            throw new LogicException("`properties` is not defined");
        }
        return $this->i['properties'];
    }

    /**
     * Defines the name
     * @param string $name
     * @return self
     */
    public function withName(string $name): self
    {
        $that = $this->blueprinted();
        $that->i['name'] = $name;
        return $that;
    }

    /**
     * Defines the manufacturer
     * @param string $name
     * @return self
     */
    public function withManufacturer(string $name): self
    {
        $that = $this->blueprinted();
        $that->i['manufacturer'] = $name;
        return $that;
    }

    /**
     * Defines the model
     * @param string $name
     * @return self
     */
    public function withModel(string $name): self
    {
        $that = $this->blueprinted();
        $that->i['model'] = $name;
        return $that;
    }

    /**
     * Defines the year when was issued
     * @param int $year
     * @return self
     */
    public function withIssued(int $year): self
    {
        $that = $this->blueprinted();
        $that->i['year'] = $year;
        return $that;
    }

    /**
     * Defines the year when was issued
     * @param int $price
     * @return self
     */
    public function withPrice(int $price): self
    {
        $that = $this->blueprinted();
        $that->i['price'] = $price;
        return $that;
    }

    /**
     * Defines the year when was issued
     * @param PropertyInterface $prop
     * @return self
     */
    public function withProperty(PropertyInterface $prop): self
    {
        $that = $this->blueprinted();
        $that->i['properties'] = $this->i['properties']->with($prop);
        return $that;
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
