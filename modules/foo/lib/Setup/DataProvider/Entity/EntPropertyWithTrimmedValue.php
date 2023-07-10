<?php

namespace Foo\Catalog\Setup\DataProvider\Entity;

/**
 * Property entity with trimmed value
 */
final class EntPropertyWithTrimmedValue extends EnvlpProperty implements MutablePropertyInterface
{
    /**
     * @inheritDoc
     */
    public function name(): string
    {
        return trim($this->origin->name());
    }

    /**
     * Clones the instance
     * @return self
     */
    public function blueprinted(): self
    {
        return new self($this->origin);
    }
}
