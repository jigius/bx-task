<?php

namespace Foo\Catalog\Setup\DataProvider\Entity\Persisted\Db\Entity;

use Foo\Catalog\Setup\DataProvider\Entity\Persisted\Db;

/**
 * Envelope for product entity
 */
abstract class EnvlpEntityProduct implements Db\EntityProductInterface
{
    /**
     * @var Db\EntityProductInterface
     */
    protected Db\EntityProductInterface $origin;

    /**
     * Cntr
     * @param Db\EntityProductInterface $origin
     */
    public function __construct(Db\EntityProductInterface $origin)
    {
        $this->origin = $origin;
    }

    /**
     * @inheritDoc
     */
    public function add(): void
    {
        $this->origin->add();
    }

    /**
     * Clones the instance
     * @return self
     */
    abstract public function blueprinted(): self;
}
