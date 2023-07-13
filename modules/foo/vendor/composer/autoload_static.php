<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit81090acd5f8c4d38cdcf3aa3a8f18366
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '667aeda72477189d0494fecd327c3641' => __DIR__ . '/..' . '/symfony/var-dumper/Resources/functions/dump.php',
        'd08a277cfbcae84bd684f25b31885740' => __DIR__ . '/../..' . '/debug.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Component\\VarDumper\\' => 28,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Component\\VarDumper\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/var-dumper',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Foo\\Catalog\\App\\BreadcrumbsInterface' => __DIR__ . '/../..' . '/lib/App/BreadcrumbsInterface.php',
        'Foo\\Catalog\\App\\BreadcrumbsVanilla' => __DIR__ . '/../..' . '/lib/App/BreadcrumbsVanilla.php',
        'Foo\\Catalog\\App\\FilterInterface' => __DIR__ . '/../..' . '/lib/App/FilterInterface.php',
        'Foo\\Catalog\\App\\FilterVanilla' => __DIR__ . '/../..' . '/lib/App/FilterVanilla.php',
        'Foo\\Catalog\\App\\GridInterface' => __DIR__ . '/../..' . '/lib/App/GridInterface.php',
        'Foo\\Catalog\\App\\GridVanilla' => __DIR__ . '/../..' . '/lib/App/GridVanilla.php',
        'Foo\\Catalog\\App\\PaginationInterface' => __DIR__ . '/../..' . '/lib/App/PaginationInterface.php',
        'Foo\\Catalog\\App\\PaginationVanilla' => __DIR__ . '/../..' . '/lib/App/PaginationVanilla.php',
        'Foo\\Catalog\\App\\URN\\UrnInterface' => __DIR__ . '/../..' . '/lib/App/URN/UrnInterface.php',
        'Foo\\Catalog\\App\\URN\\UrnVanilla' => __DIR__ . '/../..' . '/lib/App/URN/UrnVanilla.php',
        'Foo\\Catalog\\App\\UrnItemDumb' => __DIR__ . '/../..' . '/lib/App/UrnItemDumb.php',
        'Foo\\Catalog\\App\\UrnItemInterface' => __DIR__ . '/../..' . '/lib/App/UrnItemInterface.php',
        'Foo\\Catalog\\App\\UrnItemManufacturer' => __DIR__ . '/../..' . '/lib/App/UrnItemManufacturer.php',
        'Foo\\Catalog\\App\\UrnItemModel' => __DIR__ . '/../..' . '/lib/App/UrnItemModel.php',
        'Foo\\Catalog\\App\\UrnItemProduct' => __DIR__ . '/../..' . '/lib/App/UrnItemProduct.php',
        'Foo\\Catalog\\Foundation\\ExplainedToUserException' => __DIR__ . '/../..' . '/lib/Foundation/ExplainedToUserException.php',
        'Foo\\Catalog\\Foundation\\PrinterInterface' => __DIR__ . '/../..' . '/lib/Foundation/PrinterInterface.php',
        'Foo\\Catalog\\ORM\\ConfiguredEntities' => __DIR__ . '/../..' . '/lib/ORM/ConfiguredEntities.php',
        'Foo\\Catalog\\ORM\\DataManager' => __DIR__ . '/../..' . '/lib/ORM/DataManager.php',
        'Foo\\Catalog\\ORM\\ExceptionWithResult' => __DIR__ . '/../..' . '/lib/ORM/ExceptionWithResult.php',
        'Foo\\Catalog\\ORM\\IterableEntitiesInterface' => __DIR__ . '/../..' . '/lib/ORM/IterableEntitiesInterface.php',
        'Foo\\Catalog\\ORM\\ManufacturerTable' => __DIR__ . '/../..' . '/lib/ORM/ManufacturerTable.php',
        'Foo\\Catalog\\ORM\\ModelEntity' => __DIR__ . '/../..' . '/lib/ORM/ModelEntity.php',
        'Foo\\Catalog\\ORM\\ModelTable' => __DIR__ . '/../..' . '/lib/ORM/ModelTable.php',
        'Foo\\Catalog\\ORM\\OptionTable' => __DIR__ . '/../..' . '/lib/ORM/OptionTable.php',
        'Foo\\Catalog\\ORM\\ProductEntity' => __DIR__ . '/../..' . '/lib/ORM/ProductEntity.php',
        'Foo\\Catalog\\ORM\\ProductOptionEntity' => __DIR__ . '/../..' . '/lib/ORM/ProductOptionEntity.php',
        'Foo\\Catalog\\ORM\\ProductOptionTable' => __DIR__ . '/../..' . '/lib/ORM/ProductOptionTable.php',
        'Foo\\Catalog\\ORM\\ProductTable' => __DIR__ . '/../..' . '/lib/ORM/ProductTable.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\EntProduct' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/EntProduct.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\EntProductWithThrowExceptionIfValueIsEmpty' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/EntProductWithThrowExceptionIfValueIsEmpty.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\EntProductWithTrimmedValues' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/EntProductWithTrimmedValues.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\EntProperties' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/EntProperties.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\EntProperty' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/EntProperty.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\EntPropertyWithAddedLabelToValue' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/EntPropertyWithAddedLabelToValue.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\EntPropertyWithThrowExceptionIfValueIsEmpty' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/EntPropertyWithThrowExceptionIfValueIsEmpty.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\EntPropertyWithTrimmedValue' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/EntPropertyWithTrimmedValue.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\EnvlpProduct' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/EnvlpProduct.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\EnvlpProperty' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/EnvlpProperty.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\MutableProductInterface' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/MutableProductInterface.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\MutablePropertyInterface' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/MutablePropertyInterface.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\Persisted\\Db\\EntityProductInterface' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/Peristed/Db/EntityProductInterface.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\Persisted\\Db\\EntityTInterface' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/Peristed/Db/EntityTInterface.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\Persisted\\Db\\Entity\\CfgEntProduct' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/Peristed/Db/Entity/CfgEntProduct.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\Persisted\\Db\\Entity\\EntManufacturer' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/Peristed/Db/Entity/EntManufacturer.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\Persisted\\Db\\Entity\\EntModel' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/Peristed/Db/Entity/EntModel.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\Persisted\\Db\\Entity\\EntOption' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/Peristed/Db/Entity/EntOption.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\Persisted\\Db\\Entity\\EntProduct' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/Peristed/Db/Entity/EntProduct.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\Persisted\\Db\\Entity\\EnvlpEntityProduct' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/Peristed/Db/Entity/EnvlpEntityProduct.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\Persisted\\Db\\LkPkExistedEntity' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/Peristed/Db/LkPkExistedEntity.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\Persisted\\Db\\LkPkWithAddedEntityIfNotFound' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/Peristed/Db/LkPkWithAddedEntityIfNotFound.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\Persisted\\Db\\LookupCapablePKInterface' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/Peristed/Db/LookupCapablePKInterface.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\Printer\\CfgPrnProduct' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/Printer/CfgPrnProduct.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\Printer\\EnvlpPrinterProduct' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/Printer/EnvlpPrinterProduct.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\Printer\\PrinterProductInterface' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/Printer/PrinterProductInterface.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\Printer\\PrnProduct' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/Printer/PrnProduct.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\ProductInterface' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/ProductInterface.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\PropertiesInterface' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/PropertiesInterface.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Entity\\PropertyInterface' => __DIR__ . '/../..' . '/lib/Setup/DataProvider/Entity/PropertyInterface.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Reader\\CfgCsvReader' => __DIR__ . '/../..' . '/lib/Setup/SampleData/CfgCsvReader.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Reader\\CsvFileReader' => __DIR__ . '/../..' . '/lib/Setup/SampleData/CsvFileReader.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Reader\\EnvlpReader' => __DIR__ . '/../..' . '/lib/Setup/SampleData/EnvlpReader.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Reader\\FileInterface' => __DIR__ . '/../..' . '/lib/Setup/SampleData/FileInterface.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Reader\\ReaderInterface' => __DIR__ . '/../..' . '/lib/Setup/SampleData/ReaderInterface.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Reader\\ReaderWithDataKeyValRepacked' => __DIR__ . '/../..' . '/lib/Setup/SampleData/ReaderWithDataKeyValRepacked.php',
        'Foo\\Catalog\\Setup\\DataProvider\\Reader\\TextFile' => __DIR__ . '/../..' . '/lib/Setup/SampleData/TextFile.php',
        'Foo\\Catalog\\Setup\\DbScheme' => __DIR__ . '/../..' . '/lib/Setup/DbScheme.php',
        'Foo\\Catalog\\Setup\\DbSchemeInterface' => __DIR__ . '/../..' . '/lib/Setup/DbShemeInterface.php',
        'Foo\\Catalog\\Setup\\DbSchemePrj' => __DIR__ . '/../..' . '/lib/Setup/DbSchemePrj.php',
        'Foo\\Catalog\\Setup\\FilePathsInterface' => __DIR__ . '/../..' . '/lib/Setup/FilesInterface.php',
        'Foo\\Catalog\\Setup\\FilePathsPrj' => __DIR__ . '/../..' . '/lib/Setup/FilePathsPrj.php',
        'Foo\\Catalog\\Setup\\TaskInterface' => __DIR__ . '/../..' . '/lib/Setup/TaskInterface.php',
        'Foo\\Catalog\\Setup\\TskChangeDbScheme' => __DIR__ . '/../..' . '/lib/Setup/TskChangeDbScheme.php',
        'Foo\\Catalog\\Setup\\TskFedDbWithSampleData' => __DIR__ . '/../..' . '/lib/Setup/TskFedDbWithSampleData.php',
        'Foo\\Catalog\\Setup\\TskFindFootprintsIntoDbScheme' => __DIR__ . '/../..' . '/lib/Setup/TskFindFootprintsIntoDbScheme.php',
        'Foo\\Catalog\\Setup\\TskInstall' => __DIR__ . '/../..' . '/lib/Setup/TskInstall.php',
        'Foo\\Catalog\\Setup\\TskNop' => __DIR__ . '/../..' . '/lib/Setup/TskNull.php',
        'Foo\\Catalog\\Setup\\TskUninstall' => __DIR__ . '/../..' . '/lib/Setup/TskUninstall.php',
        'Foo\\Catalog\\Setup\\TskWipeDbScheme' => __DIR__ . '/../..' . '/lib/Setup/TskWipeDbScheme.php',
        'Foo\\Catalog\\Setup\\TskWithDbTransaction' => __DIR__ . '/../..' . '/lib/Setup/TskWithDbTransaction.php',
        'Foo\\Catalog\\Setup\\TskWithDeployedFiles' => __DIR__ . '/../..' . '/lib/Setup/TskWithDeployedFiles.php',
        'Foo\\Catalog\\Setup\\TskWithRemovedFiles' => __DIR__ . '/../..' . '/lib/Setup/TskWithRemovedFiles.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit81090acd5f8c4d38cdcf3aa3a8f18366::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit81090acd5f8c4d38cdcf3aa3a8f18366::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit81090acd5f8c4d38cdcf3aa3a8f18366::$classMap;

        }, null, ClassLoader::class);
    }
}
