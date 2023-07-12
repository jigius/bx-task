<?php

namespace Foo\Catalog\App;

use Bitrix\Main\UI;
use LogicException;

/**
 * Vanilla pagination instance
 */
final class PaginationVanilla implements PaginationInterface
{
    /**
     * @var array
     */
    private array $i;

    /**
     * Cntr
     */
    public function __construct()
    {
        $this->i = [
            "sizeVariants" => [
                [
                    'NAME' => "5",
                    'VALUE' => "5",
                ],
                [
                    'NAME' => "20",
                    'VALUE' => "20",
                ],
                [
                    'NAME' => "50",
                    'VALUE' => "50",
                ],
                [
                    'NAME' => "100",
                    'VALUE' => "100",
                ]
            ]
        ];
    }

    /**
     * @inheritDoc
     */
    public function withId(string $id): self
    {
        $that = $this->blueprinted();
        $that->i['id'] = $id;
        return $that;
    }

    /**
     * @inheritDoc
     * @throws LogicException
     */
    public function PageNavigation(): UI\PageNavigation
    {
        if (!isset($this->i['id'])) {
            throw new LogicException("`id` is not defined");
        }
        return new UI\PageNavigation($this->i['id']);
    }

    /**
     * @inheritDoc
     */
    public function withPageSizeVariant(string $name, int $count): self
    {
        $that = $this->blueprinted();
        $that->i['sizeVariants'][] = ["NAME" => $name, "VALUE" => $count];
        return $that;
    }

    /**
     * @inheritDoc
     */
    public function pageSizeVariants(): array
    {
        return $this->i['sizeVariants'];
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
