<?php

namespace Foo\Catalog\Setup\DataProvider\Entity\Persisted\Db;

/**
 * Contract is used for pk searching
 */
interface LookupCapablePKInterface
{
    /**
     * Returns a primary key
     * @param EntityTInterface $entity
     * @return int
     */
    public function pk(EntityTInterface $entity): int;
}
