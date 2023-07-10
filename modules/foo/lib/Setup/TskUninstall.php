<?php

namespace Foo\Catalog\Setup;

use Foo\Catalog\ORM\IterableEntitiesInterface;

/**
 * Composed stack of tasks for the executing of the module uninstallation
 */
final class TskUninstall implements TaskInterface
{
    /**
     * @var TaskInterface
     */
    private TaskInterface $origin;

    /**
     * Cntr
     * @param IterableEntitiesInterface $entities
     * @param FilePathsInterface $fPaths
     * @param bool $saveData
     */
    public function __construct(
        IterableEntitiesInterface $entities,
        FilePathsInterface $fPaths,
        bool $saveData = false
    ) {
        $this->origin = new TskWithRemovedFiles(new TskNop(), $fPaths);
        if (!$saveData) {
            $this->origin = new TskWipeDbScheme($this->origin, $entities);
        }
    }

    /**
     * @inheritDoc
     */
    public function executed(): TaskInterface
    {
        return $this->origin->executed();
    }
}
