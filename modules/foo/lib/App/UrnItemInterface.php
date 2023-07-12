<?php

namespace Foo\Catalog\App;

use Foo\Catalog\App\URN;

/**
 * Urn contract for grid's rows. Is used for the references creating.
 */
interface UrnItemInterface
{
    /**
     * @param int $id
     * @return UrnItemInterface
     */
    public function withId(int $id): URN\UrnInterface;
}
