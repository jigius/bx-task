<?php

namespace Foo\Catalog\Setup;

use Bitrix\Main\ORM\Entity;
use Foo\Catalog\ORM\IterableEntitiesInterface;

/**
 * Adds an info about project's entities into DB scheme
 */
final class TskChangeDbScheme implements TaskInterface
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
                    $entity->createDbTable();
                }
            );
        return $this->origin->executed();
    }
}