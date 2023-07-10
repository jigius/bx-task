<?php

namespace Foo\Catalog\Setup;

use Foo\Catalog\ORM;

/**
 * Configured instance for the project
 */
final class DbSchemePrj implements DbSchemeInterface
{
    /**
     * @var DbScheme
     */
    private DbScheme $origin;

    /**
     * Cntr
     */
    public function __construct()
    {
        $this->origin = new DbScheme(new ORM\ConfiguredEntities());
    }

    /**
     * @inheritDoc
     */
    public function hasFootprints(): bool
    {
        return $this->origin->hasFootprints();
    }
}
