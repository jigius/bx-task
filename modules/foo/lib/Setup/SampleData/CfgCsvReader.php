<?php

namespace Foo\Catalog\Setup\DataProvider\Reader;

/**
 * Configured reader instance for use in the project
 */
final class CfgCsvReader extends EnvlpReader
{
    /**
     * Cntr
     * @param string $pathFile
     */
    public function __construct(string $pathFile)
    {
        parent::__construct(
            new ReaderWithDataKeyValRepacked(
                new CsvFileReader(
                    (new TextFile())
                        ->opened($pathFile)
                )
            )
        );
    }
}
