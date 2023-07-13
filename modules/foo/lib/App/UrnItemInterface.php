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
     * @return Urn\UrnInterface
     */
    public function withId(int $id): URN\UrnInterface;

    /**
     * @param URN\UrnInterface $urn
     * @return UrnItemInterface
     */
    public function withOrigin(URN\UrnInterface $urn): UrnItemInterface;
}
