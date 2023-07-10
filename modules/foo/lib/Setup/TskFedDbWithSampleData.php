<?php

namespace Foo\Catalog\Setup;

use Foo\Catalog\ORM\ExceptionWithResult;
use Foo\Catalog\Setup\DataProvider\Entity\Persisted\Db\EntityProductInterface;
use Foo\Catalog\Setup\DataProvider\Entity\Printer\PrinterProductInterface;
use Foo\Catalog\Setup\DataProvider\Reader\ReaderInterface;
use Throwable;

/**
 * Feeds Db with sample data from csv-file
 */
final class TskFedDbWithSampleData implements TaskInterface
{
    /**
     * @var TaskInterface
     */
    private TaskInterface $origin;
    /**
     * @var ReaderInterface
     */
    private ReaderInterface $reader;
    /**
     * @var PrinterProductInterface
     */
    private PrinterProductInterface $printer;
    /**
     * @var EntityProductInterface
     */
    private EntityProductInterface $product;

    /**
     * Cntr
     * @param TaskInterface $task
     * @param ReaderInterface $reader
     * @param PrinterProductInterface $printer
     * @param EntityProductInterface $product
     */
    public function __construct(
        TaskInterface $task,
        ReaderInterface $reader,
        PrinterProductInterface $printer,
        EntityProductInterface $product
    ) {
        $this->origin = $task;
        $this->reader = $reader;
        $this->printer = $printer;
        $this->product = $product;
    }

    /**
     * @inheritDoc
     */
    public function executed(): TaskInterface
    {
        foreach ($this->reader as $i) {
            try {
                $this
                    ->product
                    ->withProduct(
                        $this->printer->with('data', $i)->finished()
                    )
                    ->add();
            } catch (Throwable $ex) {
                /* just bypass any exception */
                /**
                 * TODO: logging is needed!
                 */
            }
        }
        return $this->origin->executed();
    }
}
