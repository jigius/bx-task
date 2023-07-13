<?php

namespace Foo\Catalog\App;

use Bitrix\Main\ORM\Query;
use CMain;

interface GridInterface
{
    /**
     * Returns filter instance
     * @return FilterInterface
     */
    public function filter(): FilterInterface;

    /**
     * Defines grid's ID
     * @param string $id
     * @return GridInterface
     */
    public function withId(string $id): GridInterface;

    /**
     * Defines the source of data
     * @param Query\Query $query
     * @return GridInterface
     */
    public function withQuery(Query\Query $query): GridInterface;

    /**
     * Appends a column item into the bunch
     * @param string $id
     * @param string $name
     * @return GridInterface
     */
    public function withColumn(string $id, string $name): GridInterface;

    /**
     * Defines an urnitem instance
     * @param UrnItemInterface $urn
     * @return GridInterface
     */
    public function withUrn(UrnItemInterface $urn): GridInterface;


    /**
     * Outputs the grid's content
     * @param CMain $app
     * @param string $template
     * @return void
     */
    public function output(CMain $app, string $template = ".default"): void;
}
