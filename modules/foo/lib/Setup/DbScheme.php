<?php

namespace Foo\Catalog\Setup;

use Bitrix\Main\ORM\Entity;
use Foo\Catalog\ORM;

final class DbScheme implements DbSchemeInterface
{
    /**
     * @var ORM\IterableEntitiesInterface
     */
    private ORM\IterableEntitiesInterface $entities;

    /**
     * Cntr
     * @param ORM\IterableEntitiesInterface $entities
     */
    public function __construct(ORM\IterableEntitiesInterface $entities)
    {
        $this->entities = $entities;
    }

    public function hasFootprints(): bool
    {
        $found = false;
        $this
            ->entities
            ->each(
                function (Entity $entity) use (&$found): ?bool  {
                    $continue = true;
                    if ($entity->getConnection()->isTableExists($entity->getDBTableName())) {
                        $found = true;
                        $continue = false;
                    }
                    return $continue;
                }
            );
        return $found;
    }
}
