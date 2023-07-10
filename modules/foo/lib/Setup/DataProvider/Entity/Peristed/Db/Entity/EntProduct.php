<?php

namespace Foo\Catalog\Setup\DataProvider\Entity\Persisted\Db\Entity;

use Foo\Catalog\ORM;
use Foo\Catalog\Setup\DataProvider\Entity\Persisted\Db;
use Foo\Catalog\Setup\DataProvider\Entity\ProductInterface;
use Foo\Catalog\Setup\DataProvider\Entity\PropertyInterface;
use LogicException;
use Exception;

/**
 * Is used for persisting products into db
 */
final class EntProduct implements Db\EntityProductInterface
{
    /**
     * @var array{product: ProductInterface|null}
     */
    private array $i;
    /**
     * @var EntModel
     */
    private EntModel $mod;
    /**
     * @var EntOption
     */
    private EntOption $opt;
    /**
     * @var Db\LookupCapablePKInterface
     */
    private Db\LookupCapablePKInterface $look;

    /**
     * Cntr
     * @param EntModel $mod
     * @param EntOption $opt
     * @param Db\LookupCapablePKInterface $look
     */
    public function __construct(EntModel $mod, EntOption $opt, Db\LookupCapablePKInterface $look)
    {
        $this->mod = $mod;
        $this->opt = $opt;
        $this->look = $look;
        $this->i = [];
    }

    /**
     * @param ProductInterface $p
     * @return self
     */
    public function withProduct(ProductInterface $p): self
    {
        $that = $this->blueprinted();
        $that->i['product'] = $p;
        return $that;
    }

    /**
     * @inheritDoc
     * @throws LogicException|Exception
     */
    public function add(): void
    {
        if (!isset($this->i['product'])) {
            throw new LogicException("`product` is not defined");
        }
        $result = ORM\ProductTable::add(
            [
                'NAME' => $this->i['product']->name(),
                'MODEL_ID' => $this->look->pk($this->mod->withProduct($this->i['product'])),
                'ISSUED' => $this->i['product']->issued(),
                'PRICE' => $this->i['product']->price()
            ]
        );
        if (!$result->isSuccess()) {
            throw (new ORM\ExceptionWithResult("request failure"))->withResult($result);
        }
        (function (int $pid): void {
            $this
                ->i['product']
                ->properties()
                ->each(function (PropertyInterface $prop) use ($pid): void {
                    $result = ORM\ProductOptionTable::add([
                        'PRODUCT_ID' => $pid,
                        'OPTION_ID' => $this->look->pk($this->opt->withProperty($prop))
                    ]);
                    if (!$result->isSuccess()) {
                        throw (new ORM\ExceptionWithResult("request failure"))->withResult($result);
                    }
                });

        }) ($result->getId());
    }

    /**
     * Clones the instance
     * @return self
     */
    public function blueprinted(): self
    {
        $that = new self($this->mod, $this->opt, $this->look);
        $that->i = $this->i;
        return $that;
    }
}
