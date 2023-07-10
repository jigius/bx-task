<?php

namespace Foo\Catalog\Setup\DataProvider\Entity;

use LogicException;

/**
 * Vanilla implementation of property entity
 */
final class EntProperty implements MutablePropertyInterface
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
     * Defines a name
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
     * Defines a label
     * @param string $name
     * @return self
     */
    public function withLabel(string $name): self
    {
        $that = $this->blueprinted();
        $that->i['label'] = $name;
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
