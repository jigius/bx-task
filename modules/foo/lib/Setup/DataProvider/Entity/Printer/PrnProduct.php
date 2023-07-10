<?php

namespace Foo\Catalog\Setup\DataProvider\Entity\Printer;

use Foo\Catalog\Setup\DataProvider\Entity;
use LogicException;
use DomainException;
use Exception;

/**
 * Implements notebook printer
 */
final class PrnProduct implements PrinterProductInterface
{
    private const CURRENT_EURO_COURSE = 76;

    /**
     * @var array
     */
    private array $i;
    /**
     * @var Entity\EntProduct|Entity\MutableProductInterface
     */
    private Entity\EntProduct|Entity\MutableProductInterface $prod;
    /**
     * @var Entity\PropertyInterface|Entity\EntProperty
     */
    private Entity\PropertyInterface|Entity\EntProperty $prop;

    /**
     * Cntr
     */
    public function __construct(?Entity\MutableProductInterface $prod = null, ?Entity\PropertyInterface $prop = null)
    {
        $this->i = [];
        $this->prod = $prod ?? new Entity\EntProduct();
        $this->prop = $prop ?? new Entity\EntProperty();
    }

    /**
     * @inheritDoc
     */
    public function with(string $key, mixed $val): self
    {
        $that = $this->blueprinted();
        $that->i[$key] = $val;
        return $that;
    }

    /**
     * @inheritDoc
     * @throws LogicException|DomainException|Exception
     */
    public function finished(): Entity\ProductInterface
    {
        if (!isset($this->i['data'])) {
            throw new LogicException("`data` is not defined");
        }
        if (!is_array($this->i['data'])) {
            throw new LogicException("`data` has an invalid type");
        }
        /*
         * Ex
         * manufacturer,model,category,screen_size,screen,cpu,ram,storage,gpu,os,os_version,weight,price
         * Apple,MacBook Pro,Ultrabook,"13.3""",IPS Panel Retina Display 2560x1600,Intel Core i5 2.3GHz,8GB,\
         * 128GB SSD,Intel Iris Plus Graphics 640,macOS,,1.37kg,"1339,69"
         */
        $i = $this->i['data'];
        if (!isset($i['manufacturer'])) {
            throw new DomainException("data corrupted - `manufacturer` is not defined");
        }
        $prod = $this->prod->withManufacturer($i['manufacturer']);
        if (!isset($i['model'])) {
            throw new DomainException("data corrupted - `model` is not defined");
        }
        if (!preg_match("~^\s*?(\S+?)\s+?(.+)$~", $i['model'], $m)) {
            throw new DomainException("data corrupted - `model` is invalid");
        }
        $prod = $prod->withModel($m[1])->withName($m[2]);
        if (!isset($i['price'])) {
            throw new DomainException("data corrupted - `price` is not defined");
        }
        $prod = $prod->withPrice(((int)$i['price']) * self::CURRENT_EURO_COURSE);
        $prod = $prod->withIssued(random_int(2000, 2020));
        $knownProps = [
            "Display size" => "screen_size",
            "Display type" => "screen",
            "CPU" => "cpu",
            "RAM" => "ram",
            "HDD" => "storage",
            "GPU" => "gpu",
            "Operation System" => "os",
            "OS version" => "os_version",
            "Weight" => "weight"
        ];
        foreach ($knownProps as $label => $prop) {
            if (!isset($i[$prop])) {
                throw new DomainException("data corrupted - `$prop` is not defined");
            }
            try {
                $prop = $this->prop->withName($i[$prop])->withLabel($label);
                $prop->name(); /* validate */
                $prod = $prod->withProperty($prop);
            } catch (DomainException $ex) {
                /* just bypass invalid properties */
            }
        }
        return $prod;
    }

    /**
     * Clones the instance
     * @return self
     */
    public function blueprinted(): self
    {
        $that = new self($this->prod, $this->prop);
        $that->i = $this->i;
        return $that;
    }
}
