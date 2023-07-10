<?php

namespace Foo\Catalog\Setup\DataProvider\Entity;

/**
 * Envelope implementation of property entity
 */
abstract class EnvlpProperty implements MutablePropertyInterface
{
    /**
     * @var MutablePropertyInterface
     */
    protected MutablePropertyInterface $origin;

    /**
     * Cntr
     * @param MutablePropertyInterface $origin
     */
    public function __construct(MutablePropertyInterface $origin)
    {
        $this->origin = $origin;
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
    public function withName(string $name): MutablePropertyInterface
    {
        $that = $this->blueprinted();
        $that->origin = $this->origin->withName($name);
        return $that;
    }

    /**
     * @inheritDoc
     */
    public function withLabel(string $name): MutablePropertyInterface
    {
        $that = $this->blueprinted();
        $that->origin = $this->origin->withLabel($name);
        return $that;
    }

    /**
     * Clones the instance
     * @return EnvlpProperty
     */
    abstract public function blueprinted(): self;
}
