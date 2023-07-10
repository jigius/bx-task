<?php

namespace Foo\Catalog\Setup\DataProvider\Entity\Persisted\Db;

use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use LogicException;
use RuntimeException;
use DomainException;

/**
 * Instance is used for the searching a PK for a given entity
 */
final class LkPkExistedEntity implements LookupCapablePKInterface
{
    /**
     * Cntr
     */
    public function __construct()
    {
    }

    /**
     * @param EntityTInterface $entity
     * @return int
     * @throws ObjectPropertyException|SystemException|DomainException|LogicException
     */
    public function pk(EntityTInterface $entity): int
    {
        $coll = $entity->query()->fetchCollection();
        if ($coll->count() === 0) {
            throw new RuntimeException("entity not found", 404);
        } elseif ($coll->count() !== 1) {
            throw new DomainException("db scheme is corrupted");
        }
        return $coll->current()->getId();
    }
}
