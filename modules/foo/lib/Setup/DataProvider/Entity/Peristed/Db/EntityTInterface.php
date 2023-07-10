<?php

namespace Foo\Catalog\Setup\DataProvider\Entity\Persisted\Db;

use Bitrix\Main\ORM;

interface EntityTInterface
{
    /**
     * @return ORM\Query\Query
     */
    public function query(): ORM\Query\Query;

    /**
     * @return ORM\Data\AddResult
     */
    public function add(): ORM\Data\AddResult;
}
