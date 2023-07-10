<?php

namespace Foo\Catalog\Setup;

interface TaskInterface
{
    /**
     * @return TaskInterface
     */
    public function executed(): TaskInterface;
}
