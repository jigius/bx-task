<?php
namespace Foo\Catalog\Foundation;

interface PrinterInterface
{
	/**
	 * @param string $key
	 * @param mixed $val
	 * @return PrinterInterface
	 */
	public function with(string $key, mixed $val): PrinterInterface;

	/**
	 * @return mixed
	 */
	public function finished(): mixed;
}
