<?php

namespace Foo\Catalog\Setup\DataProvider\Entity;

/**
 * Notebook entity with trimmed values
 */
final class EntProductWithTrimmedValues extends EnvlpProduct implements MutableProductInterface
{
    /**
     * @inheritDoc
     */
    public function manufacturer(): string
    {
        return trim($this->origin->manufacturer());
    }

    /**
     * @inheritDoc
     */
    public function model(): string
    {
        return trim($this->origin->model());
    }

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
