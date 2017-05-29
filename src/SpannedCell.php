<?php

namespace TheDeceased\Table;

class SpannedCell implements CellInterface
{

	/**
	 * @var int
	 */
	private $colspan;

	public function __construct($colspan)
	{
		$this->colspan = $colspan;
	}

	/**
	 * @return string
	 */
	public function value()
	{
		return '';
	}

	/**
	 * @return int
	 */
	public function colspan()
	{
		return $this->colspan;
	}

	/**
	 * @return int
	 */
	public function rowspan()
	{
		return 1;
	}

	public function isVisible()
	{
		return false;
	}

	/**
	 * @return FontInterface
	 */
	public function getFont()
	{
		return new Font(); //TODO: return parent font;
	}

	/**
	 * @return string
	 */
	public function borders()
	{
		return '';
	}
}