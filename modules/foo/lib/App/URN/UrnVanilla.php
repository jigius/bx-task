<?php

namespace Foo\Catalog\App\URN;

use LogicException;

/**
 * Vanilla urn instance
 */
final class UrnVanilla implements UrnInterface
{
    /**
     * @var bool
     */
    private bool $sef;
    /**
     * @var array
     */
    private array $i;

    /**
     * Cntr
     * @param bool $sefMode
     */
    public function __construct(bool $sefMode)
    {
        $this->sef = $sefMode;
        $this->i = [];
    }

    /**
     * @inheritDoc
     */
    public function withManufacturer(int $id): self
    {
        $that = $this->blueprinted();
        $that->i['manufacturerId'] = $id;
        return $that;
    }

    /**
     * @inheritDoc
     */
    public function withModel(int $id): self
    {
        $that = $this->blueprinted();
        $that->i['modelId'] = $id;
        return $that;
    }

    /**
     * @inheritDoc
     */
    public function withProduct(int $id): self
    {
        $that = $this->blueprinted();
        $that->i['productId'] = $id;
        return $that;
    }

    /**
     * @inheritDoc
     */
    public function withBasePath(string $path): self
    {
        $that = $this->blueprinted();
        $that->i['base'] = $path;
        return $that;
    }

    /**
     * @inheritDoc
     */
    public function urn(): string
    {
        if ($this->sef) {
            $ret = $this->sefUrn();
        } else {
            $ret = $this->plainUrn();
        }
        return $ret;
    }

    /**
     * Clones the instance
     * @return self
     */
    public function blueprinted(): self
    {
        $that = new self($this->sef);
        $that->i = $this->i;
        return $that;
    }

    /**
     * Returns urn in sef mode
     * @return string
     * @throws LogicException
     */
    private function sefUrn(): string
    {
        if (!isset($this->i['base'])) {
            throw new LogicException("`base` is not defined");
        }
        if (isset($this->i['productId'])) {
            $ret = [
                "detail",
                $this->i['productId']
            ];
        } elseif (isset($this->i['modelId']) && isset($this->i['manufacturerId'])) {
            $ret = [
                $this->i['manufacturerId'],
                $this->i['modelId']
            ];
        } elseif (isset($this->i['manufacturerId'])) {
            $ret = [
                $this->i['manufacturerId']
            ];
        } else {
            $ret = [];
        }
        array_unshift($ret, rtrim($this->i['base'], "/"));
        return implode("/", $ret) . "/";
    }

    /**
     * Returns URN in plain mode
     * @return string
     * @throws LogicException
     */
    private function plainUrn(): string
    {
        if (!isset($this->i['base'])) {
            throw new LogicException("`base` is not defined");
        }
        $ret = [];
        if (isset($this->i['productId'])) {
            $ret[] = "DETAIL=" . (int)$this->i['productId'];
        } elseif (isset($this->i['modelId']) && isset($this->i['manufacturerId'])) {
            $ret[] = "BRAND=" . (int)$this->i['manufacturerId'];
            $ret[] = "MODEL=" . (int)$this->i['modelId'];
        } elseif (isset($this->i['manufacturerId'])) {
            $ret[] = "BRAND=" . (int)$this->i['manufacturerId'];
        }
        $query = implode("&", $ret);
        return rtrim($this->i['base'], "/") . "/index.php" . (!empty($query)? "?" . $query: "");
    }
}
