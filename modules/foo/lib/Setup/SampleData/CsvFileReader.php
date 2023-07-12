<?php

namespace Foo\Catalog\Setup\DataProvider\Reader;

use RuntimeException;

/**
 * Implements iterator for reading data from a csv-file
 */
final class CsvFileReader implements ReaderInterface
{
    /**
     * @var FileInterface
     */
    private FileInterface $f;

    /**
     * @var string
     */
    private string $delim;

    /**
     * @var string
     */
    private string $enc;

    /**
     * @var string
     */
    private string $esc;

    /**
     * Current offset position of a file handler on start
     * @var int|null
     */
    private ?int $ifst = null;

    /**
     * A stash for reading data from the handler
     * @var array|null
     */
    private ?array $stash = null;

    /**
     * Cntr
     * @param FileInterface $file
     * @param string $delimiter
     * @param string $enclosure
     * @param string $escape
     */
    public function __construct(
        FileInterface $file,
        string $delimiter = ",",
        string $enclosure = "\"",
        string $escape = "\\"
    ) {
        $this->f = $file;
        $this->delim = $delimiter;
        $this->enc = $enclosure;
        $this->esc = $escape;
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool
    {
        if ($this->ifst === null) {
            $this->ifst = $this->f->tell();
        }
        $key = $this->f->tell();
        $l = $this->f->gets();
        if ($l === false && !$this->f->eof()) {
            throw
            new RuntimeException(
                sprintf(
                    "An error occurs: `%s`",
                    error_get_last()['message'] ?? "unknown"
                )
            );
        }
        $position = $this->f->tell();
        $this->stash = [
            'input' => $l,
            'key' => $key,
            'position' => $position
        ];
        return !$this->f->eof();
    }

    /**
     * @inheritDoc
     */
    public function rewind(): void
    {
        if ($this->ifst === null) {
            return;
        }
        try {
            $this->f = $this->f->seeked($this->ifst);
        } catch (RuntimeException $ex) {
            throw
                new RuntimeException(
                    "error rewind pointer to a start position",
                    0,
                    $ex
                );
        }
    }

    /**
     * @inheritDoc
     */
    public function next(): void
    {
        /*
         * all job has been done into valid() method
         */
    }

    /**
     * @inheritDoc
     */
    public function key(): int
    {
        if ($this->stash === null) {
            $this->next();
        }
        return $this->stash['key'];
    }

    /**
     * @inheritDoc
     */
    public function current(): array
    {
        if ($this->stash === null) {
            $this->next();
        }
        return
            str_getcsv(
                $this->stash['input'],
                $this->delim,
                $this->enc,
                $this->esc
            );
    }
}
