<?php

namespace Foo\Catalog\Setup;

use Bitrix\Main\DB;
use Throwable;

/**
 * Wraps the original task with Db Trx
 */
final class TskWithDbTransaction implements TaskInterface
{
    /**
     * @var TaskInterface
     */
    private TaskInterface $origin;
    /**
     * @var DB\Connection
     */
    private DB\Connection $conn;

    /**
     * Cntr
     * @param TaskInterface $origin
     * @param DB\Connection $conn
     */
    public function __construct(TaskInterface $origin, DB\Connection $conn)
    {
        $this->origin = $origin;
        $this->conn = $conn;
    }

    /**
     * @inheritDoc
     * @throws DB\SqlQueryException|Throwable
     */
    public function executed(): TaskInterface
    {
        $autocommit = !!$this->conn->queryScalar("SELECT @@autocommit");
        if (!$autocommit) {
            $this->conn->queryExecute("SET AUTOCOMMIT=0");
        }
        try {
            $this->conn->startTransaction();
            $ret = $this->origin->executed();
            $this->conn->commitTransaction();
        } catch (Throwable $ex) {
            $this->conn->rollbackTransaction();
            throw $ex;
        }
        if ($autocommit) {
            $this->conn->queryExecute("SET AUTOCOMMIT=1");
        }
        return $ret;
    }
}
