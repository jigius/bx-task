<?php

namespace Foo\Catalog\App;

use Foo\Catalog\App\URN;

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
     * @param URN\UrnInterface|null $urn
     */
    public function __construct(?URN\UrnInterface $urn = null)
    {
        $this->urn = $urn ?? new URN\UrnVanilla(false);
    }

    /**
    * @inheritDoc
    */
    public function withId(int $id): URN\UrnInterface
    {
        return $this->urn->withModel($id);
    }

    /**
     * @inheritDoc
     */
    public function withOrigin(URN\UrnInterface $urn): self
    {
        $that = $this->blueprinted();
        $that->urn = $urn;
        return $that;
    }


    /**
     * Clones the instance
     * @return self
     */
    public function blueprinted(): self
    {
        return new self($this->urn);
    }
}
