<?php

namespace Foo\Catalog\Setup\DataProvider\Entity;

/**
 * Envelope implementation of notebook entity
 */
abstract class EnvlpProduct implements MutableProductInterface
{
    /**
     * @var MutableProductInterface
     */
    protected MutableProductInterface $origin;

    /**
     * Cntr
     * @param MutableProductInterface $origin
     */
    public function __construct(MutableProductInterface $origin)
    {
        $this->origin = $origin;
    }

    /**
     * @inheritDoc
     */
    public function manufacturer(): string
    {
        return $this->origin->manufacturer();
    }

    /**
     * @inheritDoc
     */
    public function model(): string
    {
        return $this->origin->model();
    }

    /**
     * @inheritDoc
     */
    public function name(): string
    {
        return $this->origin->name();
    }

    /**
     * @inheritDoc
     */
    public function price(): int
    {
        return $this->origin->price();
    }

    /**
     * @inheritDoc
     */
    public function issued(): int
    {
        return $this->origin->issued();
    }

    /**
     * @inheritDoc
     */
    public function properties(): PropertiesInterface
    {
        return $this->origin->properties();
    }

    /**
     * @inheritDoc
     */
    public function withName(string $name): MutableProductInterface
    {
        $that = $this->blueprinted();
        $that->origin = $this->origin->withName($name);
        return $that;
    }

    /**
     * @inheritDoc
     */
    public function withManufacturer(string $name): MutableProductInterface
    {
        $that = $this->blueprinted();
        $that->origin = $this->origin->withManufacturer($name);
        return $that;
    }

    /**
     * @inheritDoc
     */
    public function withModel(string $name): MutableProductInterface
    {
        $that = $this->blueprinted();
        $that->origin = $this->origin->withModel($name);
        return $that;
    }

    /**
     * @inheritDoc
     */
    public function withIssued(int $year): MutableProductInterface
    {
        $that = $this->blueprinted();
        $that->origin = $this->origin->withIssued($year);
        return $that;
    }

    /**
     * @inheritDoc
     */
    public function withPrice(int $price): MutableProductInterface
    {
        $that = $this->blueprinted();
        $that->origin = $this->origin->withPrice($price);
        return $that;
    }

    /**
     * @inheritDoc
     */
    public function withProperty(PropertyInterface $prop): MutableProductInterface
    {
        $that = $this->blueprinted();
        $that->origin = $this->origin->withProperty($prop);
        return $that;
    }

    /**
     * Clones the instance
     * @return EnvlpProduct
     */
    abstract public function blueprinted(): self;
}
