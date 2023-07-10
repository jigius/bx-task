<?php

namespace Foo\Catalog\ORM;

use Bitrix\Main\ORM\Data\Result;
use RuntimeException;
use LogicException;
use Throwable;

/**
 * Used for pass a result instance with an orm exception
 */
final class ExceptionWithResult extends RuntimeException
{
    /**
     * @var array{result: Result|null}
     */
    private array $i;

    /**
     * Cntr
     * @inheritDoc
     */
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->i = [];
    }

    /**
     * Stores result instance
     * @param Result $r
     * @return self
     */
    public function withResult(Result $r): self
    {
        $that = $this->blueprinted();
        $that->i['result'] = $r;
        return $that;
    }

    /**
     * Returns result instance
     * @return Result
     */
    public function result(): Result
    {
        if (!isset($this->i['result'])) {
            throw new LogicException("`result` is not defined");
        }
        return $this->i['result'];
    }

    /**
     * Clones the instance
     * @return self
     */
    public function blueprinted(): self
    {
        $that = new self();
        $that->i = $this->i;
        return $that;
    }
}
