<?php

namespace Foo\Catalog\Setup;

/**
 * Collection of paths
 */
interface FilePathsInterface
{
    /**
     * @param bool $full - returns full paths or not
     * @return iterable
     */
    public function filePaths(bool $full = true): iterable;
}
