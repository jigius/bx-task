<?php

namespace Foo\Catalog\Setup;

/**
 * Defines the current set of files are intended for installation/uninstallation tasks
 */
final class FilePathsPrj implements FilePathsInterface
{
    /**
     * @var string
     */
    private string $base;

    /**
     * @param string $basePath
     */
    public function __construct(string $basePath)
    {
        $this->base = $basePath;
    }

    /**
     * @inheritDoc
     */
    public function filePaths(bool $full = true): iterable
    {
        $ret = [
            [
                "/local/modules/foo/install/components",
                "/local/components/foo"
            ]
        ];
        if ($full) {
            $ret =
                array_map(
                    function (array $itm): array {
                        foreach ($itm as $key => $val) {
                            $itm[$key] = implode(
                                "",
                                [
                                    rtrim($this->base, "/"),
                                    "/",
                                    ltrim($val, "/")
                                ]
                            );
                        }
                        return $itm;
                    },
                    $ret
                );
        }
        return $ret;
    }
}
