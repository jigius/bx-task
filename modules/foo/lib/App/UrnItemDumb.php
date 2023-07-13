<?php

namespace Foo\Catalog\App;

use LogicException;

/**
 * Dumb implementation/ Is used for stub
 */
final class UrnItemDumb implements UrnItemInterface
{
    /**
     * Cntr
     */
    public function __construct()
    {
    }

    /**
     * @inheritDoc
     * @throws LogicException
     */
    public function withId(int $id): URN\UrnInterface
    {
        throw new LogicException("just a dump");
    }

    /**
     * @inheritDoc
     * @throws LogicException
     */
    public function withOrigin(URN\UrnInterface $urn): self
    {
        throw new LogicException("just a dump");
    }
}
