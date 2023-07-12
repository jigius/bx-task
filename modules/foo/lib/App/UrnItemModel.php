<?php

namespace Foo\Catalog\App;

/**
 * Transforms item's id assigment to well configured urn instance
 */
final class UrnItemModel implements UrnItemInterface
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
        return $this->urn->withModel($id);
    }
}
