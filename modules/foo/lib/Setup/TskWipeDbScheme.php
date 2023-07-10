<?php

namespace Foo\Catalog\Setup;

use Bitrix\Main\ORM\Entity;
use Foo\Catalog\ORM\IterableEntitiesInterface;

/**
 * Wipes out the configured project's orm-entities from db scheme
 */
final class TskWipeDbScheme implements TaskInterface
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
        $this
            ->entities
            ->each(
                function (Entity $entity) {
                    $table = $entity->getDBTableName();
                    if ($entity->getConnection()->isTableExists($table)) {
                        $entity->getConnection()->queryExecute("DROP TABLE `$table`");
                    }
                }
            );
        return $this->origin->executed();
    }
}
