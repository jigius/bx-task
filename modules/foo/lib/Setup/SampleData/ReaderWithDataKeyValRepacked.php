<?php

namespace Foo\Catalog\Setup\DataProvider\Reader;

final class ReaderWithDataKeyValRepacked implements ReaderInterface
{
    /**
     * @var ReaderInterface
     */
    private ReaderInterface $origin;
    /**
     * @var array|null
     */
    private ?array $firstRow;

    /**
     * Cntr
     * @param ReaderInterface $origin
     */
    public function __construct(ReaderInterface $origin)
    {
        $this->origin = $origin;
        $this->firstRow = null;
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool
    {
        $ret = $this->origin->valid();
        if ($ret && $this->firstRow === null) {
            $this->firstRow = $this->origin->current();
            $ret = $this->origin->valid();
        }
        return $ret;
    }

    /**
     * @inheritDoc
     */
    public function rewind(): void
    {
        $this->firstRow = null;
        $this->origin->rewind();
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
    public function key(): int
    {
        return $this->origin->key();
    }

    /**
     * @inheritDoc
     */
    public function current(): array
    {
        $ret = $this->origin->current();
        if ($ret && $this->firstRow) {
            $ret = array_combine($this->firstRow, $ret);
        }
        return $ret;
    }
}
