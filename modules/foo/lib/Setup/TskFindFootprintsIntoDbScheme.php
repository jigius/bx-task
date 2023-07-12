<?php

namespace Foo\Catalog\Setup;

use Bitrix\Main\ORM\Entity;
use Foo\Catalog\ORM\IterableEntitiesInterface;

/**
 * Finds a footprints of the configured project's orm-entities into db scheme
 */
final class TskFindFootprintsIntoDbScheme implements TaskInterface
{
    /**
     * @var TaskInterface
     */
    private TaskInterface $origin;
    /**
     * @var IterableEntitiesInterface
     */
    private IterableEntitiesInterface $entities;

    /**
     * Cntr
     * @param TaskInterface $task
     * @param IterableEntitiesInterface $entities
     */
    public function __construct(TaskInterface $task, IterableEntitiesInterface $entities)
    {
        $this->origin = $task;
        $this->entities = $entities;
    }

    /**
     * @inheritDoc
     */
    public function executed(): TaskInterface
    {
        $found = false;
        $this
            ->entities
            ->each(
                function (Entity $entity) use (&$found): ?bool {
                    $continue = true;
                    if ($entity->getConnection()->isTableExists($entity->getDBTableName())) {
                        $found = true;
                        $continue = false;
                    }
                    return $continue;
                }
            );
        if ($found) {
            $ret = $this;
        } else {
            $ret = $this->origin->executed();
        }
        return $ret;
    }
}
