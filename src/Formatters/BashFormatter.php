<?php

namespace TheDeceased\Table\Formatters;

use TheDeceased\Table\TableInterface;

class BashFormatter implements FormatterInterface
{
	/**
	 * @var TableInterface
	 */
	private $table;
	/**
	 * @var int
	 */
	private $columnWidth;

	public function __construct(TableInterface $table, $columnWidth = 20)
	{
		$this->table = $table;
		$this->columnWidth = $columnWidth;
	}

	public function output()
	{
		$out = '';
		$a = 0;
		foreach ($this->table->getRows() as $row) {
			foreach ($row->getCells() as $cell) {
				$value = $cell->value();
				$colspan = $cell->colspan();
				$cellWidth = $colspan * $this->columnWidth;
				if (mb_strlen($value) > $cellWidth) {
					$value = mb_substr($value, 0, $cellWidth);
				} else {
					$value = $value . str_repeat(' ', $cellWidth - mb_strlen($value) + $colspan - 1);
				}
				$out .= $value . '|';
			}
			$out .= PHP_EOL;
			$a++;
		}
		return $out;
	}
}