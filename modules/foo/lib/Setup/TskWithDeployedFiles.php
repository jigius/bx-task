<?php

namespace Foo\Catalog\Setup;

use http\Exception\RuntimeException;
use LogicException;

/**
 * Deploy module's files
 */
final class TskWithDeployedFiles implements TaskInterface
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
        foreach ($this->fPaths->filePaths() as $i) {
            if (count($i) !== 2) {
                throw new LogicException("invalid type");
            }
            list($from, $to) = $i;
            if (CopyDirFiles($from, $to, true, true) === false) {
                throw new RuntimeException("coping files failure");
            }
        }
        return $this->origin->executed();
    }
}
