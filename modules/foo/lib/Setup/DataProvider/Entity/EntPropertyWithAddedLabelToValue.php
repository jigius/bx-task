<?php

namespace Foo\Catalog\Setup\DataProvider\Entity;

/**
 * Property entity with appended label to the original value
 */
final class EntPropertyWithAddedLabelToValue extends EnvlpProperty implements MutablePropertyInterface
{
    /**
     * @var array
     */
    private array $i;

    /**
     * @param MutablePropertyInterface $origin
     */
    public function __construct(MutablePropertyInterface $origin)
    {
        parent::__construct($origin);
        $this->i = [];
    }

    /**
     * @inheritDoc
     */
    public function withLabel(string $name): self
    {
        $that = $this->blueprinted();
        $that->i['label'] = $name;
        $that->origin = $this->origin->withLabel($name);
        return $that;
    }

    /**
     * @inheritDoc
     */
    public function name(): string
    {
        $ret = $this->origin->name();
        if (!empty($ret) && !empty($this->i['label'])) {
            $ret = $this->i['label'] . ": " . $ret;
        }
        return $ret;
    }

    /**
     * Clones the instance
     * @return self
     */
    public function blueprinted(): self
    {
        $that = new self($this->origin);
        $that->i = $this->i;
        return $that;
    }
}
