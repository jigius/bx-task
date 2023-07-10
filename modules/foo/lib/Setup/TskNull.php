<?php

namespace Foo\Catalog\Setup;

/**
 * Task with No Operations. Is used into chain of calls.
 */

final class TskNop implements TaskInterface
{
    /**
     * Cntr
     */
    public function __construct()
    {
    }

    /**
     * @inheritDoc
     */
    public function executed(): self
    {
        return $this;
    }
}
