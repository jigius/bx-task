<?php

namespace Foo\Catalog\Setup\DataProvider\Entity\Persisted\Db;

use Foo\Catalog\ORM;
use RuntimeException;
use Exception;

/**
 * The instance is used for the creating a new entity when the original not find it
 */
final class LkPkWithAddedEntityIfNotFound implements LookupCapablePKInterface
{
    /**
     * @var LookupCapablePKInterface
     */
    private LookupCapablePKInterface $origin;

    /**
     * Cntr
     * @param LookupCapablePKInterface $origin
     */
    public function __construct(LookupCapablePKInterface $origin)
    {
        $this->origin = $origin;
    }

    /**
     * @param EntityTInterface $entity
     * @return int
     * @throws Exception
     */
    public function pk(EntityTInterface $entity): int
    {
        try {
            $ret = $this->origin->pk($entity);
        } catch (RuntimeException $ex) {
            if ($ex->getCode() != 404) {
                throw $ex;
            }
            $result = $entity->add();
            if (!$result->isSuccess()) {
                throw (new ORM\ExceptionWithResult("request failure", 0, $ex))->withResult($result);
            }
            $ret = $result->getId();
        }
        return $ret;
    }
}
