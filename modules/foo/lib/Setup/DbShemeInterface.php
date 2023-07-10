<?php

namespace Foo\Catalog\Setup;

/**
 * Catches various information about project's db scheme
 */
interface DbSchemeInterface
{
    /**
     * Check if db schema is changed by the project
     * @return bool
     */
    public function hasFootprints(): bool;
}
