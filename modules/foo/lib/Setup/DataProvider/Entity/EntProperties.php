<?php

namespace Foo\Catalog\Setup\DataProvider\Entity;

/**
 * Vanilla implementation of properties entity
 */
final class EntProperties implements PropertiesInterface
{
    /**
     * @var array|string[]
     */
    private array $i;

    public function __construct()
    {
        $this->i = [];
    }

    /**
     * @inheritDoc
     */
    public function with(PropertyInterface $prop): PropertiesInterface
    {
        $that = $this->blueprinted();
        $that->i[] = $prop;
        return $that;
    }

    /**
     * @inheritDoc
     */
    public function each(callable $callee): void
    {
        foreach ($this->i as $prop) {
            if (call_user_func($callee, $prop) === false) {
                break;
            }
        }
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