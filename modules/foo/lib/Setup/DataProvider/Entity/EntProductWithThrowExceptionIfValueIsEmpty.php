<?php

namespace Foo\Catalog\Setup\DataProvider\Entity;

use DomainException;

/**
 * Notebook entity with the validation if a values is empty
 */
final class EntProductWithThrowExceptionIfValueIsEmpty extends EnvlpProduct implements MutableProductInterface
{
    /**
     * @inheritDoc
     * @throws DomainException
     */
    public function manufacturer(): string
    {
        $origin = $this->origin->manufacturer();
        if (empty($origin)) {
            throw new DomainException("value is empty");
        }
        return $origin;
    }

    /**
     * @inheritDoc
     * @throws DomainException
     */
    public function model(): string
    {
        $origin = $this->origin->model();
        if (empty($origin)) {
            throw new DomainException("value is empty");
        }
        return $origin;
    }

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
     * @inheritDoc
     * @throws DomainException
     */
    public function issued(): int
    {
        $origin = $this->origin->issued();
        if (empty($origin)) {
            throw new DomainException("value is empty");
        }
        return $origin;
    }

    /**
     * @inheritDoc
     * @throws DomainException
     */
    public function price(): int
    {
        $origin = $this->origin->price();
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
