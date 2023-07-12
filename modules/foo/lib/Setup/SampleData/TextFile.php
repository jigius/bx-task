<?php

namespace Foo\Catalog\Setup\DataProvider\Reader;

use RuntimeException;
use LogicException;

/**
 * Implements contact is working with a text file
 */
final class TextFile implements FileInterface
{
    /**
     * @var array
     */
    private array $i;

    /**
     * Cntr
     */
    public function __construct()
    {
        $this->i = [];
    }

    /**
     * @inheritDoc
     * @throws LogicException|RuntimeException
     */
    public function opened(string $pathname, string $mode = "r"): FileInterface
    {
        $h = fopen($pathname, $mode);
        if ($h === false) {
            throw
                new RuntimeException(
                    "Couldn't open file=`$pathname` with mode=`{$mode}`",
                    0,
                    new RuntimeException(
                        error_get_last()['message'] ?? "Unknown"
                    )
                );
        }
        $obj = $this->blueprinted();
        $obj->i =
            [
                'h' => $h,
                'pathfile' => $pathname,
                'mode' => $mode
            ];
        return $obj;
    }

    /**
     * @inheritDoc
     * @throws LogicException|RuntimeException
     */
    public function close(): void
    {
        if (!isset($this->i['h'])) {
            return;
        }
        if (!@fclose($this->i['h'])) {
            throw
                new RuntimeException(
                    "Couldn't close handler fo file=`{$this->i['pathfile']}`",
                    0,
                    new RuntimeException(
                        error_get_last()['message'] ?? "Unknown"
                    )
                );
        }
    }

    /**
     * @inheritDoc
     */
    public function eof(): bool
    {
        if (!isset($this->i['h'])) {
            throw new LogicException("the file is not opened");
        }
        return @feof($this->i['h']);
    }

    /**
     * @inheritDoc
     * @throws LogicException
     */
    public function gets()
    {
        if (!isset($this->i['h'])) {
            throw new LogicException("the file is not opened");
        }
        return @fgets($this->i['h']);
    }

    /**
     * @inheritDoc
     * @throws LogicException
     */
    public function seeked(int $pos): FileInterface
    {
        if (!isset($this->i['h'])) {
            throw new LogicException("the file is not opened");
        }
        $obj = $this->blueprinted();
        if (@fseek($obj->i['h'], $pos) !== 0) {
            throw
                new RuntimeException(
                    "Couldn't set a new position to file=`{$this->i['pathfile']}`'s handler's pointer",
                    0,
                    new RuntimeException(
                        error_get_last()['message'] ?? "Unknown"
                    )
                );
        }
        return $obj;
    }

    /**
     * @inheritDoc
     * @throws LogicException
     */
    public function tell(): int
    {
        if (!isset($this->i['h'])) {
            throw new LogicException("the file is not opened");
        }
        $position = @ftell($this->i['h']);
        if ($position === false) {
            throw
                new RuntimeException(
                    "error getting of the current pointer position of file=`{$this->i['pathfile']}`",
                    0,
                    new RuntimeException(
                        error_get_last()['message'] ?? "Unknown"
                    )
                );
        }
        return $position;
    }

    /**
     * Clones the instance to an new one
     * @return $this
     */
    private function blueprinted(): self
    {
        $obj = new self();
        $obj->i = $this->i;
        return $obj;
    }
}
