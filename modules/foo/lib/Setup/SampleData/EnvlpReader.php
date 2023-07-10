<?php

namespace Foo\Catalog\Setup\DataProvider\Reader;

/**
 * Envelope for reader contract
 */
abstract class EnvlpReader implements ReaderInterface
{
    /**
     * @var ReaderInterface
     */
    private ReaderInterface $origin;

    /**
     * Cntr
     * @param ReaderInterface $origin
     */
    public function __construct(ReaderInterface $origin)
    {
        $this->origin = $origin;
    }

    /**
     * @inheritDoc
     */
    public function current(): array
    {
        return $this->origin->current();
    }

    /**
     * @inheritDoc
     */
    public function key(): mixed
    {
        return $this->origin->key();
    }

    /**
     * @inheritDoc
     */
    public function next(): void
    {
        $this->origin->next();
    }

    /**
     * @inheritDoc
     */
    public function rewind(): void
    {
        $this->origin->rewind();
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool
    {
        return $this->origin->valid();
    }
}
