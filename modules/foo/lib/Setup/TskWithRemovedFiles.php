<?php

namespace Foo\Catalog\Setup;

use http\Exception\RuntimeException;
use LogicException;

/**
 * Removes module's files
 */
final class TskWithRemovedFiles implements TaskInterface
{
    /**
     * @var TaskInterface
     */
    private TaskInterface $origin;
    /**
     * @var FilePathsInterface
     */
    private FilePathsInterface $fPaths;

    /**
     * Cntr
     * @param TaskInterface $origin
     * @param FilePathsInterface $Paths
     */
    public function __construct(TaskInterface $origin, FilePathsInterface $Paths)
    {
        $this->origin = $origin;
        $this->fPaths = $Paths;
    }

    /**
     * @inheritDoc
     * @throws LogicException
     */
    public function executed(): TaskInterface
    {
        /*
         * Due the task requirements - article d.
         */
        /*foreach ($this->fPaths->filePaths(false) as $i) {
            if (count($i) !== 2) {
                throw new LogicException("invalid type");
            }
            list($from, $to) = $i;
            if (DeleteDirFilesEx($to) === false) {
                throw new RuntimeException("deleting files failure");
            }
        }*/
        return $this->origin->executed();
    }
}
