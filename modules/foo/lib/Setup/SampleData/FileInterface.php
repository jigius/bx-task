<?php

namespace Foo\Catalog\Setup\DataProvider\Reader;

/**
 * File contract
 */
interface FileInterface
{
    /**
     * @param string $pathname
     * @param string $mode
     * @return FileInterface
     */
    public function opened(string $pathname, string $mode): FileInterface;

    /**
     * @return mixed
     */
    public function gets();

    /**
     * @return int
     */
    public function tell(): int;

    /**
     * @param int $pos
     * @return FileInterface
     */
    public function seeked(int $pos): FileInterface;

    /**
     * @return bool
     */
    public function eof(): bool;

    /**
     * @return void
     */
    public function close(): void;
}