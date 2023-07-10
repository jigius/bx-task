<?php

namespace Foo\Catalog\Setup\DataProvider\Entity;

use DomainException;

/**
 * Property entity with the validation if a value is empty
 */
final class EntPropertyWithThrowExceptionIfValueIsEmpty extends EnvlpProperty implements MutablePropertyInterface
{
    /**
     * @inheritDoc
     * @throws DomainException
     */
    public function name(): string
    {
        $origin = $this->origin->name();
        if (empty($origin)) {
            throw new DomainException("value is empty");
        }
        return $origin;
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
