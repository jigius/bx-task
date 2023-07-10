<?php

namespace Foo\Catalog\Setup;

use Bitrix\Main\DB\Connection;
use Foo\Catalog\ORM\IterableEntitiesInterface;
use Bitrix\Main\DB;

/**
 * Composed stack of tasks for the executing of the module installation
 */
final class TskInstall implements TaskInterface
{
    /**
     * @var TaskInterface
     */
    private TaskInterface $origin;

    /**
     * Cntr
     * @param Connection $conn
     * @param IterableEntitiesInterface $entities
     * @param string $csvFileWithSamples
     * @param FilePathsInterface $fPaths
     * @param bool $clean
     */
    public function __construct(
        DB\Connection $conn,
        IterableEntitiesInterface $entities,
        string $csvFileWithSamples,
        FilePathsInterface $fPaths,
        bool $clean = true
    ) {
        $this->origin = new TskWithDeployedFiles(new TskNop(), $fPaths);
        if ($clean) {
            $this->origin =
                new TskWipeDbScheme(
                    new TskChangeDbScheme(
                        new TskWithDbTransaction(
                            new TskFedDbWithSampleData(
                                $this->origin,
                                new DataProvider\Reader\CfgCsvReader($csvFileWithSamples),
                                new DataProvider\Entity\Printer\CfgPrnProduct(),
                                new DataProvider\Entity\Persisted\Db\Entity\CfgEntProduct()
                            ),
                            $conn
                        ),
                        $entities
                    ),
                    $entities
                );
        }
    }

    /**
     * @inheritDoc
     */
    public function executed(): TaskInterface
    {
        return $this->origin->executed();
    }
}
