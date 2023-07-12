<?php

namespace Foo\Catalog\App;

/**
 * Transforms item's id assigment to well configured urn instance
 */
final class UrnItemProduct implements UrnItemInterface
{
     /**
      * @var URN\UrnInterface
      */
     private URN\UrnInterface $urn;

     /**
      * Cntr
      * @param URN\UrnInterface $urn
      */
     public function __construct(URN\UrnInterface $urn)
    {
        $this->urn = $urn;
    }

    /**
     * @inheritDoc
     */
    public function withId(int $id): URN\UrnInterface
    {
        return $this->urn->withProduct($id);
    }
}