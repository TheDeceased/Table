<?php

namespace TheDeceased\Table;

class Cell implements CellInterface
{
	/** @var array */
	private $cellData;
	/** @var FontInterface */
	private $font;

	public function __construct(array $cellData)
	{
		$this->cellData = $cellData;
	}

	/**
	 * @param FontInterface $font
	 */
	public function setFont(FontInterface $font)
	{
		$this->font = $font;
	}

	/**
	 * @return string
	 */
	public function value()
	{
		return (string)(!empty($this->cellData['value']) ? $this->cellData['value'] : '');
	}

	/**
	 * @return int
	 */
	public function colspan()
	{
		return !empty($this->cellData['colspan']) ? (int)$this->cellData['colspan'] : 1;
	}

	/**
	 * @return int
	 */
	public function rowspan()
	{
		return !empty($this->cellData['rowspan']) ? (int)$this->cellData['rowspan'] : 1;
	}

	/**
	 * @return string
	 */
	public function borders()
	{
		return !empty($this->cellData['borders']) ? $this->cellData['borders'] : '';
	}

	/**
	 * @return string
	 */
	public function background()
	{
		return !empty($this->cellData['background']) ? $this->cellData['background'] : '';
	}

	/**
	 * @return FontInterface
	 */
	public function getFont()
	{
		return $this->font ?: new Font();
	}

	/**
	 * @return bool
	 */
	public function isVisible()
	{
		return true;
	}
}